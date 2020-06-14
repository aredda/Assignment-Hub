<?php

function wrap($tag, $content) {
    return "<$tag>" . $content . "</$tag>";
}

function is_empty($value, $alt) {
    if ($value == null || $value == "")
        return $alt;
    return $value;
}

function post($key) {
    if (isset($_POST[$key]) && !empty($_POST[$key]))
        return $_POST[$key];
    return null;
}

function get($key) {
    if (isset($_GET[$key]) && !empty($_GET[$key]))
        return $_GET[$key];
    return null;
}

class Node {

    public $tag;
    public $attributes = array();
    public $children = array();

    public function __construct($tag) {
        $this->tag = $tag;
    }

    public function add($element) {
        array_push($this->children, $element);
    }

    public function addAttribute($attr, $val) {
        array_push($this->attributes, "$attr='$val'");
    }

    public function toString() {
        return "<$this->tag " . implode(" ", $this->attributes) . ">" . implode("", $this->children) . "</$this->tag>";
    }

}
