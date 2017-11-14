<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class TypeComment
{

    const avenir = "avenir";
    const photo = "photo";
    const flashback = "flashback";

    public static function checkValidComment($type)
    {
        switch ($type) {
            case TypeComment::avenir:
                return true;
            case TypeComment::photo:
                return true;
            case TypeComment::flashback:
                return true;
            default:
                return false;
        }
    }

}
