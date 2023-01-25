<?php
function from12HTo24H($time)
{
    return date("H:i", strtotime($time));
}

function from24HTo12H($time)
{
    return date("g:i A", strtotime($time));
}

function convert12HTo24H($time)
{
    return date("h:i A", strtotime($time));
}

function date_only($date)
{
    return date("d.m.Y", strtotime($date));
}

function date_time($date)
{
    return date("d.m.Y - h:i A", strtotime($date));
}


function timeFormat()
{
    return ['12', '24'];
}

/*function days($lang = null)
{
    return [
        'S' => 'Saturday',
        'U' => 'Sunday',
        'M' => 'Monday',
        'T' => 'Tuesday',
        'W' => 'Wednesday',
        'R' => 'Thursday',
        'F' => 'Friday',
    ];
}*/
function transDays()
{
    return [
        'Saturday' => 'السبت',
        'Sunday' => 'الأحد',
        'Monday' => 'الإثنين',
        'Tuesday' => 'الثلاثاء',
        'Wednesday' => 'الأربعاء',
        'Thursday' => 'الخميس',
        'Friday' => 'الجمعة',
    ];
}

function days($lang = null)
{
    return [
        'S' => 'السبت',
        'U' => 'الأحد',
        'M' => 'الإثنين',
        'T' => 'الثلاثاء',
        'W' => 'الأربعاء',
        'R' => 'الخميس',
        'F' => 'الجمعة',
    ];
}


function shortDays()
{
    return [
        'Saturday' => 'S',
        'Sunday' => 'U',
        'Monday' => 'M',
        'Tuesday' => 'T',
        'Wednesday' => 'W',
        'Thursday' => 'R',
        'Friday' => 'F',
    ];
}

function daysShort()
{
    return [
        'S' => 'S',
        'U' => 'U',
        'M' => 'M',
        'T' => 'T',
        'W' => 'W',
        'R' => 'R',
        'F' => 'F',
    ];
}

function daysShortName()
{
    return [
        'S' => 'Sat',
        'U' => 'Sun',
        'M' => 'Mon',
        'T' => 'Tue',
        'W' => 'Wed',
        'R' => 'Thu',
        'F' => 'Fri',
    ];


}

function month()
{
    return [
        "January" => "يناير",
        "February" => "فبراير",
        "March" => "مارس",
        "April" => "أبريل",
        "May" => "مايو",
        "June" => "يونيو",
        "July" => "يوليو",
        "August" => "أغسطس",
        "September" => "سبتمبر",
        "October" => "أكتوبر",
        "November" => "نوفمبر",
        "December" => "ديسمبر"
    ];


}
