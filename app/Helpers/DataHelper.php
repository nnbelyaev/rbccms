<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class DataHelper {
    protected $bannerKeywords = [];
    protected $rubricsDict;

    public function addBannerKeyword($keyword) {
        $this->bannerKeywords[] = $keyword;
    }

    public function getBannerKeywords() {
        return implode(',', $this->bannerKeywords);
    }

    public function getRubricsDict() {
        if (!$this->rubricsDict) {
            $this->rubricsDict = app()->get('RubricRepository')->getRubricDict();
        }
        return $this->rubricsDict;
    }

    public function wrPublicationUrl($publication) {
        if (!$this->rubricsDict) {
            $this->rubricsDict = app()->get('RubricRepository')->getRubricDict();
        }
        return route('publication.show', ['rubric' => $this->rubricsDict->find($publication->rubric_id)->slug, 'publication' => $publication->slug]);
    }

    public function getAllowedResources() {
        $path = app_path().'/Http/Controllers/Manage';

        $actions = [];
        $objects = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path), \RecursiveIteratorIterator::SELF_FIRST);
        foreach($objects as $name => $fObject){
            if ($fObject->isFile()) {
                if (! preg_match('/Controller\.php$/', $name)) { continue; }
                $conBaseName = strtolower(str_replace('Controller', '', basename($name, '.php')));
                $conClass = str_replace([app_path(),'/','.php'],['\App','\\',''], $fObject->getPathname());
                $class = new \ReflectionClass($conClass);
                $namespace = strtolower(str_replace('App\Http\Controllers\Manage\\', '', $class->getNamespaceName()));
                if ($namespace == 'app\http\controllers\manage') $namespace = 'default';
                $methods = $class->getMethods(\ReflectionMethod::IS_PUBLIC);
                foreach ($methods as $method) {
                    if ($method->class == (string)$class->name && $method->getName() != '__construct') {
                        $actions[$namespace][$conBaseName][] = $method->getName();
                    }
                }
            }
        }
        return $actions;
    }

    public static function getDirFilesRecursive($path, $filterRegExp = null, $dirsOnly = false, &$tmpArr = array())
    {
        foreach (new RecursiveDirectoryIterator($path) as $child) {
            if ($child->isFile()) {
                if (! $dirsOnly) {
                    $pathname = realpath($child->getPathname());
                    if (is_null($filterRegExp) || preg_match($filterRegExp, $pathname)) {
                        $tmpArr[] = $pathname;
                    }
                }
            } else {
                if ($dirsOnly && $child->isDir()) {
                    $pathname = realpath($child->getPathname());
                    if (is_null($filterRegExp) || preg_match($filterRegExp, $pathname)) {
                        $tmpArr[] = $pathname;
                    }
                }
                self::getDirFilesRecursive($child, $filterRegExp, $dirsOnly, $tmpArr);
            }
        }
        return $tmpArr;
    }
}