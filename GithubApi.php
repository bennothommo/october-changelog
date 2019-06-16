<?php
namespace October\Changelog;

/**
 * Interacts with, and manipulates, data from the GitHub API for a single repo.
 *
 * @author Ben Thomson
 */
class GithubApi
{
    /**
     * User agent definition for GitHub API.
     */
    const USER_AGENT = 'octobercms';

    /**
     * API Username to use in calls.
     *
     * @var string
     */
    protected $apiUsername;

    /**
     * API Token to use in calls.
     *
     * @var string
     */
    protected $apiToken;

    /**
     * The Repository to interact with.
     *
     * @var string
     */
    protected $repo;

    public function __construct(string $apiUsername = null, string $apiToken = null, string $repo = null)
    {
        if (isset($apiUsername)) {
            $this->apiUsername = $apiUsername;
        }
        if (isset($apiToken)) {
            $this->apiToken = $apiToken;
        }
        if (isset($repo)) {
            $this->repo = $repo;
        }
    }

    public function getApiUsername(): string
    {
        return $this->apiUsername;
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    public function getRepo(): string
    {
        return $this->repo;
    }

    public function setApiUsername(string $apiUsername): self
    {
        $this->apiUsername = $apiUsername;
        return $this;
    }

    public function setApiToken(string $apiToken): self
    {
        $this->apiToken = $apiToken;
        return $this;
    }

    public function setRepo(string $repo): self
    {
        $this->repo = $repo;
        return $this;
    }

    public function getRecentTag(): array
    {
        try {
            $response = $this->request('GET', 'tags');
        } catch (\Exception $e) {
            throw new $e;
        }

        return $response['body'][0];
    }

    public function getCommitDate(string $sha): \DateTime
    {
        $response = $this->request('GET', 'commits/' . $sha);
        $date = $response['body']['commit']['committer']['date']
            ?? $response['body']['commit']['author']['date']
            ?? null;
        
        if (!isset($date)) {
            throw new \Exception('Unable to determine date for commit.');
        }

        return new \DateTime($date);
    }

    public function getCommitsToBranch(string $branch, \DateTimeInterface $since = null): array
    {
        $page = 1;
        $data = [
            'sha' => $branch
        ];
        if (isset($since)) {
            $data['since'] = $since->format('c');
        }
        $response = $this->request('GET', 'commits', $data);
        $commits = $response['body'];

        if (!count($commits)) {
            return [];
        }

        $collated = array_map(function ($commit) {
            return [
                'sha' => $commit['sha'],
                'date' => new \DateTime($commit['commit']['committer']['date'] ?? $commit['commit']['author']['date']),
                'author' => $commit['author']['login'] ?? $commit['committer']['login'],
                'message' => $commit['commit']['message'],
                'pulls' => [],
                'label' => null,
            ];
        }, $commits);

        while ($response['hasAnotherPage']) {
            $response = $this->request('GET', 'commits', $data, ++$page);
            $commits = $response['body'];
    
            if (!count($commits)) {
                break;
            }
    
            $collated = array_map(function ($commit) {
                return [
                    'sha' => $commit['sha'],
                    'date' => new \DateTime($commit['commit']['committer']['date'] ?? $commit['commit']['author']['date']),
                    'author' => $commit['author']['login'] ?? $commit['committer']['login'],
                    'message' => $commit['commit']['message'],
                    'pulls' => [],
                    'label' => null,
                ];
            }, $commits);
        }

        return $collated;
    }

    public function getLinkedPullRequests(array $collated): array
    {
        foreach ($collated as &$commit) {
            $response = $this->request('GET', 'commits/' . $commit['sha'] . '/pulls');
            if (!empty($response['body']) && count($response['body'])) {
                foreach ($response['body'] as $pull) {
                    $commit['pulls'][] = $pull['number'];
        
                    // Determine label
                    if (!empty($pull['labels']) && count($pull['labels']) && $commit['label'] === null) {
                        foreach ($pull['labels'] as $label) {
                            if (preg_match('/^Type:\s+(.*?)$/i', $label['name'], $matches)) {
                                $commit['label'] = $matches[1];
                            }
                        }
                    }
                }
            }
        }
        
        return $collated;
    }

    public function getPendingFile()
    {
        try {
            $response = $this->request('GET', 'contents/PENDING.md');
        } catch (\Exception $e) {
            throw new $e;
        }
        
        return $response['body']['sha'] ?? null;
    }

    public function replacePendingFile(string $content, string $sha = null)
    {
        $data = [
            'message' => 'Update changelog ' . date('c'),
            'content' => base64_encode($content),
        ];
        if (!empty($sha)) {
            $data['sha'] = $sha;
        }

        try {
            $response = $this->request('PUT', 'contents/PENDING.md', $data);
        } catch (\Exception $e) {
            throw new $e;
        }

        return $response['body'][0];
    }

    protected function request(string $method, string $url, array $data = [], int $page = 1, int $perPage = 100)
    {
        $method = (in_array(strtoupper($method), ['GET', 'POST', 'PUT'])) ? strtoupper($method) : 'GET';
    
        if ($method === 'GET') {
            $data += [
                'page' => $page,
                'per_page' => $perPage,
            ];
        }

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 4,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => (($method !== 'GET') ? json_encode($data) : null),
            CURLOPT_URL => 'https://api.github.com/repos/' . $this->repo . '/' . $url . (($method === 'GET') ? '?' . http_build_query($data) : ''),
            CURLOPT_USERPWD => $this->apiUsername . ':' . $this->apiToken,
            CURLOPT_HTTPHEADER => [
                'Accept: application/vnd.github.groot-preview+json',
                'User-Agent: ' . self::USER_AGENT,
            ]
        ]);
    
        $response = curl_exec($curl);
    
        if ($response === false) {
            throw new \Exception(curl_error($curl));
        }
    
        // Split headers from body
        [$headers, $body] = preg_split('/\r\n\r\n/', $response, 2);
    
        // Parse headers
        preg_match_all('/^([a-z0-9\-\_\s]+):\s(.*?)$/im', $headers, $matches, PREG_SET_ORDER);
        $headers = [];
    
        foreach ($matches as $match) {
            $headers[$match[1]] = $match[2];
        }
    
        // Determine if we have another page
        $anotherPage = false;
    
        if (!empty($headers['Link'])) {
            $links = preg_split('/,\s*/', $headers['Link']);
            foreach ($links as $link) {
                $linkParts = preg_split('/;\s*/', $link);
                if ($linkParts[1] === 'rel="next') {
                    $anotherPage = true;
                }
            }
        }
    
        return [
            'headers' => $headers,
            'body' => json_decode($body, true),
            'hasAnotherPage' => $anotherPage,
        ];
    }
}