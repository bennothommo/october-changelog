<?php
namespace October\Changelog;

/**
 * Takes an array of collated commits and renders them as a Markdown-based changelog document.
 *
 * @author Ben Thomson
 */
class Changelog
{
    /**
     * Array of collated commits to render in Markdown.
     *
     * @var array
     */
    public $commits = [];

    public function __construct(array $commits = [])
    {
        $this->commits = $commits;
    }

    public function render(): string
    {
        $output = $this->renderHeader();

        $commits = $this->commits;
        $output .= $this->renderGroupedCommits($commits);
        $output .= $this->renderOtherCommits($commits);

        $output .= $this->renderContributors();

        return $output;
    }

    protected function renderHeader(): string
    {
        return '# Pending changes for release';
    }

    protected function renderGroupedCommits(array &$commits = []): string
    {
        if (!count($commits)) {
            return '';
        }

        $content = '';

        // Look for enhancements, maintenance and bug fixes
        $enhancements = [];
        $maintenance = [];
        $bugs = [];

        foreach ($commits as $section => &$sectionCommits) {
            foreach ($sectionCommits as $i => $commit) {
                if (in_array($commit['label'], ['Enhancement', 'Conceptual Enhancement'])) {
                    $commit['type'] = $section;
                    $enhancements[] = $commit;
                    unset($sectionCommits[$i]);
                    continue;
                }

                if (in_array($commit['label'], ['Maintenance'])) {
                    $commit['type'] = $section;
                    $maintenance[] = $commit;
                    unset($sectionCommits[$i]);
                    continue;
                }

                if (in_array($commit['label'], ['Bug'])) {
                    $commit['type'] = $section;
                    $bugs[] = $commit;
                    unset($sectionCommits[$i]);
                    continue;
                }
            }
        }

        // Add sections
        if (count($enhancements)) {
            $content .= "\n\n";
            $content .= '## Enhancements and New Features';

            foreach ($enhancements as $enhancement) {
                $content .= "\n" . '- ' . $enhancement['message'];
                if (count($enhancement['pulls'])) {
                    $content .= ' (' . $this->renderPRLink($enhancement['type'], $enhancement['pulls'][0]) . ')';
                } else {
                    $content .= ' (' . $this->renderShaLink($enhancement['type'], $enhancement['sha']) . ')';
                }
            }
        }

        if (count($maintenance)) {
            $content .= "\n\n";
            $content .= '## API and Feature Changes';

            foreach ($maintenance as $maintenance) {
                $content .= "\n" . '- ' . $maintenance['message'];
                if (count($maintenance['pulls'])) {
                    $content .= ' (' . $this->renderPRLink($maintenance['type'], $maintenance['pulls'][0]) . ')';
                } else {
                    $content .= ' (' . $this->renderShaLink($maintenance['type'], $maintenance['sha']) . ')';
                }
            }
        }

        if (count($bugs)) {
            $content .= "\n\n";
            $content .= '## Bug fixes';

            foreach ($bugs as $bug) {
                $content .= "\n" . '- ' . $bug['message'];
                if (count($bug['pulls'])) {
                    $content .= ' (' . $this->renderPRLink($bug['type'], $bug['pulls'][0]) . ')';
                } else {
                    $content .= ' (' . $this->renderShaLink($bug['type'], $bug['sha']) . ')';
                }
            }
        }

        return $content;
    }

    protected function renderOtherCommits(array $commits = []): string
    {
        if (!count($commits)) {
            return '';
        }

        $content = "\n\n";
        $content .= '## Other changes';

        foreach ($commits as $section => $sectionCommits) {
            foreach ($sectionCommits as $i => $commit) {
                $content .= "\n" . '- ' . $commit['message'];
                if (count($commit['pulls'])) {
                    $content .= ' (' . $this->renderPRLink($section, $commit['pulls'][0]) . ')';
                } else {
                    $content .= ' (' . $this->renderShaLink($section, $commit['sha']) . ')';
                }
            }
        }

        return $content;
    }

    protected function renderContributors(): string
    {
        if (!count($this->commits)) {
            return '';
        }

        $content = "\n\n---\n\n";
        $content .= "We would like to thank the following people for their contributions to this release:\n";

        // Determine authors
        $authors = [];
        foreach ($this->commits as $sectionCommits) {
            foreach ($sectionCommits as $i => $commit) {
                if (!in_array($commit['author'], $authors)) {
                    $authors[] = $commit['author'];
                    continue;
                }
            }
        }

        if (count($authors)) {
            sort($authors, SORT_NATURAL | SORT_FLAG_CASE);
            foreach ($authors as $author) {
                $content .= "\n" . '- **@' . $author . '**';
            }
        }

        return $content;
    }

    protected function renderPRLink(string $type, $pullRequest): string
    {
        $content = '[' . $type . '#' . $pullRequest . '](';
        if ($type === 'october') {
            $content .= 'https://github.com/octobercms/october/pull/' . $pullRequest;
        } else {
            $content .= 'https://github.com/octobercms/library/pull/' . $pullRequest;
        }
        $content .= ')';

        return $content;
    }

    protected function renderShaLink(string $type, $sha): string
    {
        $content = '[' . $type . '@`' . substr($sha, 0, 8) . '`](';
        if ($type === 'october') {
            $content .= 'https://github.com/octobercms/october/commit/' . $sha;
        } else {
            $content .= 'https://github.com/octobercms/library/commit/' . $sha;
        }
        $content .= ')';

        return $content;
    }
}