<?php

namespace App\Helpers;

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
}