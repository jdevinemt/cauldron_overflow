<?php

namespace App\Service;

use Doctrine\Common\Annotations\Annotation\Attributes;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

/**
 *
 */
class MarkdownHelper
{

    private MarkdownParserInterface $markdownParser;
    private CacheInterface $cache;
    private bool $isDebug;
    private LoggerInterface $logger;

    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache, bool $isDebug, LoggerInterface $mdLogger)
    {
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
        $this->isDebug = $isDebug;
        $this->logger = $mdLogger;
    }

    public function parse(string $source): string
    {
        if(stripos($source, 'cat') !== false){
            $this->logger->info('Meow');
        }

        if($this->isDebug) return $this->getParsedSource($source);

        return $this->cache->get('markdown_'.md5($source), fn() => $this->getParsedSource($source));
    }

    private function getParsedSource(string $source): string
    {
        return $this->markdownParser->transformMarkdown($source);
    }

}