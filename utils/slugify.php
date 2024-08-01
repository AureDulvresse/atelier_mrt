<?php
// utils/slugify.php
function slugify($text)
{
    // Remplace les caractères non alphanumériques par des tirets
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // Convertit en minuscules
    $text = strtolower($text);
    // Supprime les caractères indésirables
    $text = preg_replace('~[^-\w]+~', '', $text);
    // Supprime les tirets en début et fin de chaîne
    $text = trim($text, '-');
    // Remplace les multiples tirets par un seul
    $text = preg_replace('~-+~', '-', $text);
    return $text;
}
