<?php
enum Status: string
{
    case INVITED = 'invited';
    case JOINED = 'joined';
}

echo "" . Status::INVITED->value;