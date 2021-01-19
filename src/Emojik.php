<?php

namespace PantheraStudio\Emojik;

use PantheraStudio\Emojik\Exceptions\{IsNull, UnknownEmoji, UnknownMethod, UnknownUnicode};

class Emojik {
    public static function parse($value) {
        // Exploser la chaine de caractères en tableau php.
        $result = explode(" ", $value);

        // Définir un tableau vide
        $emoji_array = [];

        // Remplir le tableau vide avec les mots qui contient uniquement les prefixes/suffices ":"
        foreach ($result as $r) {
            $length = strlen($r);
            if ((substr($r, 0, 1) == ":") && substr($r, $length-1, $length) == ":") {
                array_push($emoji_array, $r);
            }
        }

        // Définition d'un nouveau tableau pour le prochain filtre
        $array = [];

        // Pour chaque émoji on retire les ":" pour épurer les mots.
        foreach ($emoji_array as $val) {
            array_push($array, str_replace(":", " ", $val));
        }

        // Epuration des mots, évitons les espaces blancs
        $result = implode("", $array);
        $result2 = preg_split("/[\s,]+/", $result);
        $result3 = array_filter($result2);

        // Définition du dernier tableau pour ajouter les ":"
        $emoji = [];

        foreach ($result3 as $r3) {
            array_push($emoji, ":".$r3.":");
        }

        // Cette partie compare les émojis noté a ceux enregistré dans le fichier config.php
        $raw = require("config/emoji.php");

        foreach ($raw as $key => $r) {
            foreach ($emoji as $emo) {
                if ($key == $emo) {
                    $value = str_replace($key, $r, $value);
                }
            }
        }

        // Et nous retournons la chaine de caratère avec la transformation.
        return $value;
    }

    private function getEmojis() : array {
        return require("config/emoji.php");
    }

    public function findByName($emojiName = null) : String {
        if (is_null($emojiName)) {
            throw IsNull::create("Error name");
        }

        $emoji = strtolower($emojiName);

        if (!array_key_exists($emoji, $this->getEmojis())) {
            throw UnknownEmoji::create($emoji);
        }

        return $this->getEmojis()[$emoji];
    }
    public function findByUnicode($unicode = null) : string {
        if (is_null($unicode)) {
            throw IsNull::create("Error UTF-8");
        }

        $emojis = array_flip($this->getEmojis());

        if (!array_key_exists($unicode, $emojis)) {
            throw UnknownUnicode::create($unicode);
        }

        return $emojis[$unicode];
    }
    public function __call($name, $arguments) {
        if (!method_exists(new static, $name)) {
            throw UnknownMethod::create($name);
        }
    }
}