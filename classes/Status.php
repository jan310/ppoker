<!-- 
  
    Enum für status einer Teilnahme

-->

<?php
enum Status: string
{
    case INVITED = 'invited';
    case JOINED = 'joined';
    case HOST = 'host';
}
