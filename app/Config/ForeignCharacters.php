<?php

namespace Config;

use CodeIgniter\Config\ForeignCharacters as BaseForeignCharacters;

/**
 * @immutable
 */
class ForeignCharacters extends BaseForeignCharacters
{
        public function __construct()
{
    parent::__construct();
    
        $this->characterList = array_merge($this->characterList, [
            '/ñ/u' => 'n',
            '/Ñ/u' => 'N',
            '/á|à|ä|â|ã|å|ā/u' => 'a',
            '/é|è|ë|ê|ē/u'     => 'e',
            '/í|ì|ï|î|ī/u'     => 'i',
            '/ó|ò|ö|ô|õ|ō/u'   => 'o',
            '/ú|ù|ü|û|ū/u'     => 'u',
        ]);
    }
}