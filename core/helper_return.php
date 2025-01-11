<?php
namespace Core;

enum ReturnTypes: string{
    case VIEW = "Core\View";
    case RESPONSE = "Core\Response";
}