<?php 

function custom_function($param)
{
    return strtoupper($param);
}

function view($viewName, $data = [])
{
    $viewPath = __DIR__ . '/views/';
    $cachePath = __DIR__ . '/cache/';
    $filePath = $viewPath . $viewName . '.php';

    // Check if the file exists
    if (!file_exists($filePath)) {
        echo "View file does not exist: " . htmlspecialchars($filePath);
        return;
    }

    extract($data);

    $content = file_get_contents($filePath);

    // Convert template syntax to PHP
    $content = str_replace(['{{', '}}'], ['<?php echo ', ';?>'], $content);

    // Handle if-else directives
    $content = preg_replace('/@if\(\s*(.+?)\s*\)/', '<?php if ($1): ?>', $content);
    $content = str_replace('@else', '<?php else: ?>', $content);
    $content = str_replace('@endif', '<?php endif; ?>', $content);

    // Handle foreach directives
    $content = preg_replace('/@foreach\(\s*(.+?)\s+as\s+(.+?)\s*\)/', '<?php foreach ($1 as $2): ?>', $content);
    $content = str_replace('@endforeach', '<?php endforeach; ?>', $content);

    // Handle include directives
    $content = preg_replace_callback('/@include\(\s*["\'](.+?)["\']\s*\)/', function ($matches) use ($data) {
        ob_start();
        view($matches[1], $data);
        return ob_get_clean();
    }, $content);

    // Handle loop control
    $content = str_replace('@continue', '<?php continue; ?>', $content);
    $content = str_replace('@break', '<?php break; ?>', $content);

    // Handle custom functions
    $content = preg_replace('/@call\(\s*([a-zA-Z0-9_]+)\((.*?)\)\s*\)/', '<?php echo $1($2); ?>', $content);

    // Handle comments
    $content = preg_replace('/@comment\s*(.*?)\s*@endcomment/s', '<?php /* $1 */ ?>', $content);

    // Handle variable assignments
    $content = preg_replace('/@set\(\s*([$a-zA-Z0-9_]+)\s*=\s*(.+?)\s*\)/', '<?php $1 = $2; ?>', $content);

    // Debug output
    // echo '<pre>' . htmlspecialchars($content) . '</pre>'; // Debugging step

    $cacheFile = $cachePath . $viewName . '.php';
    file_put_contents($cacheFile,$content);
    require $cacheFile;
}

$data = [
    'name' => 'John Doe',
    'age' => 60,
    'items' => ['Item 1', 'Item 2', 'Item 3']
];

view('welcome', $data);