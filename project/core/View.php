<?php

namespace Project\Core;

class View
{
    public function render(string $template, array $data = []): string
    {
        $path = base_path('app/Views/' . $template . '.php');
        if (!is_file($path)) {
            throw new \RuntimeException("View bulunamadı: {$template}");
        }

        extract($data, EXTR_SKIP);
        ob_start();
        include $path;
        return (string) ob_get_clean();
    }
}
