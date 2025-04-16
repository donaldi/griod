<?php

namespace KateMorley\Grid\UI;

use KateMorley\Grid\State\State;
use KateMorley\Grid\UI\GDate;

/** Outputs the energy transition section. */
class Transition
{
    /**
     * Outputs the energy transition section.
     *
     * @param State $state The state
     */
    public static function output(State $state): void
    {
        ?>
        <section id="transition">
          <h2>
            Eadar-ghluasad a’ Chumhachd
          </h2>
          <p>
            Eadar 12 Faoilleach 1882, nuair a dh’fhosgail a’ chiad stèisean-cumhachd guail aig 57
Holburn Viaduct ann an Lunnainn, agus 30 Sultain 2024, nuair a dhùin an stèisean-
cumhachd guail mu dheireadh ann am Breatainn, loisg an dùthaich 4.6 billean tunna de
ghual, a’ cur a-mach <a href="https://interactive.carbonbrief.org/coal-phaseout-UK/">10.6 billean tunna de charbon dà-ogsaid.</a>.
          </p>
          <p>
            Ann an 2001 dh’ùraich an t-Aonadh Eòrpach Steòrnadh nan Ionadan-losgaidh Mòra, a thug
air stèiseanan cumhachd na h-eimiseanan aca a lùghdachadh, no dùnadh, ro 2015. Mar
thoradh air seo, dhùin a’ mhòr-chuid de na stèisean-cumhachd guail a bu shine ann am
Breatainn. Thug an riaghaltas a-steach ùrlar prìs carbon ann an 2013, a chaidh suas ann an
2015, agus le sin cha b’ urrainn gual farpais ri gas, agus ghabh gas àite guail ann am
measgachadh cumhachd na dùthcha.
          </p>
          <p>
            Aig an aon àm bha gintinn lùth ath-nuadhachail a’ sìor dhol am meud. Tha Breatainn ann an
suidheachadh fosgailte ann an Iar-Thuath na h-Atlantaig agus le sin ’s e aon de na h-
àiteachan as fheàrr air an t-saoghal airson lùth gaoithe, agus tha cuid de na tuathanasan-
gaoithe as motha air an t-saoghal ann an uisgeachan eu-domhainn a’ Chuain a Tuath.
          </p>
          <p>
            Tha clàran gaoithe ùra air an dèanamh gu cunbhalach, agus eadar <?= GDate::fmt(
                "g:ia",
                $state->windRecord->time
            ) ?>
            agus <?= GDate::fmt(
                "g:ia",
                $state->windRecord->time + 1800
            ) ?> air <?= GDate::fmt("jS F Y", $state->windRecord->time) ?>,  b’ e gintinn cuibheasach tuathanasan-gaoithe Bhreatainn <?= Value::formatPower($state->windRecord->power) ?>GW, clàr ùr eile.
          </p>
          <table class="wind-milestones">
            <tr><th>Cumhachd</th><th>Dèit a’ chiad choileanaidh</th></tr>
<?php foreach ($state->windMilestones as $power => $time) { ?>
            <tr><td><?= $power ?><abbr>GW</abbr></td><td><?= GDate::fmt(
    "jS F Y",
    $time
) ?></td></tr>
<?php } ?>
          </table>
        </section>
<?php
    }
}
