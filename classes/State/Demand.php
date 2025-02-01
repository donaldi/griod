<?php

namespace KateMorley\Grid\State;

/** Represents details of demand. */
class Demand extends Map
{
    public const DEMAND = "demand";
    public const FOSSILS = "fossils";
    public const RENEWABLES = "renewables";
    public const OTHERS = "others";
    public const TRANSFERS = "transfers";

    public const KEYS = [
        self::DEMAND => "Iarrtas",
        self::FOSSILS => "Connaidhean-fosail",
        self::RENEWABLES => "Ath-nuadhachail",
        self::OTHERS => "Bunan eile",
        self::TRANSFERS => "Aiseag lùth",
    ];

    private float $generation;

    /**
     * Constructs a new instance.
     *
     * @param Types     $types     Details of power generation by type
     * @param Transfers $transfers Details of transfers
     */
    public function __construct(Types $types, Transfers $transfers)
    {
        $fossils = round($types->get(Types::FOSSILS), 1);
        $renewables = round($types->get(Types::RENEWABLES), 1);
        $others = round($types->get(Types::OTHERS), 1);
        $transfers = round($transfers->getTotal(), 1);

        $this->generation = $fossils + $renewables + $others;

        $this->map[self::DEMAND] = $this->generation + $transfers;
        $this->map[self::FOSSILS] = $fossils;
        $this->map[self::RENEWABLES] = $renewables;
        $this->map[self::OTHERS] = $others;
        $this->map[self::TRANSFERS] = $transfers;
    }

    /**
     * Returns the total power generation. This differs from calling getTotal() on
     * a Generation instance as return value is calculated from values that have
     * already been rounded, and hence is suitable for display in equations.
     */
    public function getGeneration(): float
    {
        return $this->generation;
    }
}
