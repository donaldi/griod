<?php

namespace KateMorley\Grid\State;

/** Represents details of power generation. */
class Generation extends Map
{
    public const COAL = "coal";
    public const GAS = "gas";
    public const SOLAR = "solar";
    public const WIND = "wind";
    public const HYDROELECTRIC = "hydro";
    public const NUCLEAR = "nuclear";
    public const BIOMASS = "biomass";

    public const KEYS = [
        self::COAL => "Gual",
        self::GAS => "Gas",
        self::SOLAR => "Grèine",
        self::WIND => "Gaoth",
        self::HYDROELECTRIC => "Dealan-uisge",
        self::NUCLEAR => "Niuclasach",
        self::BIOMASS => "Bith-thomad",
    ];

    protected const KEY_COMPONENTS = [
        self::COAL => ["coal"],
        self::GAS => ["ocgt", "ccgt"],
        self::SOLAR => ["embedded_solar"],
        self::WIND => ["embedded_wind", "wind"],
        self::HYDROELECTRIC => ["hydro"],
        self::NUCLEAR => ["nuclear"],
        self::BIOMASS => ["biomass"],
    ];
}
