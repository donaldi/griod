<?php

namespace KateMorley\Grid\UI;

use KateMorley\Grid\State\Datum;
use KateMorley\Grid\State\Demand;

/** Outputs the demand equation. */
class Equation {
  /**
   * Outputs the demand equation.
   *
   * @param Datum $datum The datum
   * @param bool  $help  Whether to show the help
   */
  public static function output(Datum $datum, bool $help = false): void {
    $transfers = $datum->demand->get(Demand::TRANSFERS);

?>
          <dl data-operator="<?= ($transfers < 0 ? '−' : '+') ?>">
            <dt>Iarrtas<?php if ($help) { ?> <span data-help="<p>’S e an t-iarrtas na tha de chumhachd ga thoirt bhon Ghriod Nàiseanta. Leis gu bheil an griod air a chothromachadh, tha an t-iarrtas co-ionann ris a’ chumhachd a tha air a gintinn còmhla ris a’ chumhachd a tha air a h-aiseag chun a’ ghriod.</p>"></span><?php } ?></dt>
            <dd><?= Value::formatTotalPower($datum->demand->get(Demand::DEMAND)) ?><abbr>GW</abbr></dd>
            <dt>Gintinn<?php if ($help) { ?> <span data-help="<p>Tha a’ mhòr-chuid den chumhachd dealain a tha air a chleachdadh ann am Breatainn air a ghintinn le stèiseanan cumhachd air feadh na dùthcha. Tha na stèiseanan sin a’ cleachdadh trì seòrsaichean connaidh:<p><p>Connaidhean-fosail – na tha air fhàgail de lusan agus de bheathaichean bhon àm a dh’fhalbh. Nuair a tha iad air an losgadh airson cumhachd a dhèanamh, tha carbon dà-ogsaid agus stuthan-truaillidh eile air an leigeil mu sgaoil. Tha seo a’ cur ri èiginn na gnàth-shìde agus a’ milleadh slàinte dhaoine.</p><p>Connaidhean ath-nuadhachail – stòran a tha air an ùrachadh gu luath agus gu nàdarra. Tha cleachdadh chonnaidhean ath-nuadhachail seach chonnaidhean-fosail a’ lùghdachadh eimiseanan carbon dà-ogsaid gu mòr.</p><p>Stòran eile – stòran a tha nan roghainn nas fheàrr ’s dòcha na connaidhean-fosail ach a tha a’ fàgail droch bhuaidh eile, mar eisimpleir sgudal rèidio-beò agus sgrios seann choilltean.</p>"></span><?php } ?></dt>
            <dd><?= Value::formatTotalPower($datum->demand->getGeneration()) ?><abbr>GW</abbr></dd>
            <dt>Aiseag lùth<?php if ($help) { ?> <span data-help="<p>Chan fheum a’ ghintinn agus an t-iarrtas a bhith co-ionann leis gun gabh lùth aiseag bho dhùthaich gu dùthaich agus bho shiostam-stòraidh gu siostam-stòraidh. Tha càballan ris an canar eadar-cheanglaichearan a’ ceangal a’ Ghriod Nàiseanta ri lìonrathan-sgaoilidh dealain ann an dùthchannan a tha faisg oirnn, agus ag aiseag lùth bho dhùthchannan far a bheil prìs an dealain nas ìsle gu dùthchannan far a bheil a' phrìs nas àirde.</p><p>Bidh siostaman-stòraidh a’ stòradh lùth nuair a tha prìs an dealain nas ìsle agus ga leigeil a-mach nuair a tha a’ phrìs nas àirde. Roimhe, b’ e siostamam-stòraidh air am pumpadh bu chumanta, ach tha siostaman-stòraidh le bataraidhean nas cumanta a-nis leis gu bheil cosgaisean air a dhol sìos.</p><p>Tha luchd-ruith nan eadar-cheanglaichearan agus nan siostaman-stòraidh a’ dèanamh prothaid bhon diofar ann am prìsean dealain ann an diofar dhùthchannan thar ùine. Tha iad cuideachd a’ dèanamh solar an dealain nas cinntiche agus a’ cumail phrìsean seasmhach nuair a tha an t-iarrtas agus a’ ghintinn ag atharrachadh.</p>"></span><?php } ?></dt>
            <dd><?= Value::formatTotalPower(abs($transfers)) ?><abbr>GW</abbr></dd>
          </dl>
<?php
  }
}
