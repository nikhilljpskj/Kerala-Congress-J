<?php

if (!function_exists('asset_url')) {
    function asset_url(string $path): string
    {
        if (preg_match('#^(?:https?:)?//#', $path) || strpos($path, 'data:') === 0) {
            return $path;
        }

        $parts = parse_url($path);
        $assetPath = $parts['path'] ?? $path;
        $relativePath = ltrim($assetPath, '/');
        $filePath = BASE_PATH . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativePath);
        $version = is_file($filePath) ? (string) filemtime($filePath) : null;

        $query = $parts['query'] ?? '';
        if ($version !== null) {
            $query = $query ? $query . '&v=' . $version : 'v=' . $version;
        }

        $url = rtrim(BASE_URL, '/') . '/' . $relativePath;
        if ($query !== '') {
            $url .= '?' . $query;
        }
        if (!empty($parts['fragment'])) {
            $url .= '#' . $parts['fragment'];
        }

        return $url;
    }
}
