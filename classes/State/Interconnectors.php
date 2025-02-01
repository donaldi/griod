<?php

namespace KateMorley\Grid\State;

/** Represents details of interconnectors. */
class Interconnectors extends Map
{
    public const BELGIUM = "belgium";
    public const DENMARK = "denmark";
    public const FRANCE = "france";
    public const IRELAND = "ireland";
    public const NETHERLANDS = "netherlands";
    public const NORWAY = "norway";

    public const KEYS = [
        self::BELGIUM => "A’ Bheilg",
        self::DENMARK => "An Danmhairg",
        self::FRANCE => "An Fhraing",
        self::IRELAND => "Èirinn",
        self::NETHERLANDS => "Na Tìrean Ìseal",
        self::NORWAY => "Nirribhidh",
    ];

    protected const KEY_COMPONENTS = [
        self::BELGIUM => ["nemo"],
        self::DENMARK => ["viking"],
        self::FRANCE => ["ifa", "ifa2", "eleclink"],
        self::IRELAND => ["moyle", "ewic", "greenlink"],
        self::NETHERLANDS => ["britned"],
        self::NORWAY => ["nsl"],
    ];
}
