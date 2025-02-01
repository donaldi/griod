<?php

namespace KateMorley\Grid\State;

/** Represents details of power generation by type. */
class Types extends Map
{
    public const FOSSILS = "fossils";
    public const RENEWABLES = "renewables";
    public const OTHERS = "others";

    public const KEYS = [
        self::FOSSILS => "Connaidhean-fosail",
        self::RENEWABLES => "Ath-nuadhachail",
        self::OTHERS => "Bunan eile",
    ];

    protected const KEY_COMPONENTS = [
        self::FOSSILS => ["coal", "ocgt", "ccgt"],
        self::RENEWABLES => [
            "embedded_solar",
            "embedded_wind",
            "wind",
            "hydro",
        ],
        self::OTHERS => ["nuclear", "biomass"],
    ];
}
