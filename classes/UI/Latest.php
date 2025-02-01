<?php

namespace KateMorley\Grid\UI;

use KateMorley\Grid\State\Datum;
use KateMorley\Grid\State\Generation;
use KateMorley\Grid\State\Interconnectors;
use KateMorley\Grid\State\Map;
use KateMorley\Grid\State\Storage;
use KateMorley\Grid\State\Types;
use KateMorley\Grid\UI\PieChart;

/** Outputs the latest data. */
class Latest {
  /**
   * Outputs the latest data.
   *
   * @param Datum $datum The datum
   */
  public static function output(Datum $datum): void {
?>
      <div id="latest">
        <section id="generation">
          <h2>Gintinn</h2>
          <div class="pie-chart-container">
            <?php PieChart::output($datum); ?>
          </div>
          <div>
            Nota: tha ceudachdan a rèir an iarrtais, agus bidh iad seachad air 100% ma tha cumhachd ga às-mhalairt 
          </div>
        </section>
<?php

    $demand = $datum->getTotal();

?>
        <section id="fossils">
          <h2><?= Value::formatPercentage($datum->types->get(Types::FOSSILS) / $demand) ?>% connaidhean-fosail</h2>
<?php

    self::outputTable($datum->generation, [
      Generation::GAS  => '<p>Tha stèiseanan-cumhachd gas a’ losgadh gas airson tuirbin obrachadh. Gu tric, bidh an teas a bharrachd bho losgadh a’ ghas air a chleachdadh airson smùid a dhèanamh gus tuirbin eile obrachadh cuideachd. Le losgadh gas nàdarra tha carbon dà-ogsaid agus stuthan-truaillidh eile air an cur a-mach, agus tha seo a’ cur ri èiginn na gnàth-shìde agus a’ milleadh slàinte dhaoine.</p><p>Ann an 2001 chuir an t-Aonadh Eòrpach a-mach stiùireadh gum feumadh stèiseanan cumhachd na h-eimiseanan aca a lùghdachadh, no dùnadh, ro 2015. Ann am Breatainn, dhùin a’ mhòr-chuid de na stèiseanan cumhachd a bha a’ losgadh gual, agus an uair sin b’ ann bho stèiseanan-cumhachd gas a thàinig a’ mhòr-chuid de chumhachd Bhreatainn.</p>'
    ], $demand);

?>
        </section>
        <section id="renewables">
          <h2><?= Value::formatPercentage($datum->types->get(Types::RENEWABLES) / $demand) ?>% bunan ath-nuadhachail</h2>
<?php

    self::outputTable($datum->generation, [
      Generation::SOLAR         => '<p>Tha panailean-grèine a’ gintinn cumhachd le buaidh fotobholtaig, nuair a tha solas a tha a’ bualadh air stuth a’ dèanamh sruth-dealain.</p><p>Ged a tha Breatainn gu math fada tuath ’s ged a tha an aimsir sgòthach gu math tric, ’s urrainn panailean-grèine cumhachd gu leòr a dhèanamh airson a bhith feumail. Tha panailean-grèine air mullaich dhachaighean air fàs cumanta mar a tha prìs nam panailean-grèine air tuiteam.</p><p>Tha panailean-grèine ceangailte ris an lìonra-sgaoilidh ionadail seach ris an lìonra-sgaoilidh nàiseanta, agus le sin tha ESO a’ Ghriod Nàiseanta dìreach a’ toirt tuairmse air na tha iad a’ gintinn, stèidhichte air an aimsir agus air an iarrtas a tha ri fhaicinn san lìonra.</p>',
      Generation::WIND          => '<p>Tha tuirbinean-gaoithe a’ gintinn cumhachd le gluasad na h-èadhair. Faodar tuirbinean a chur air tìr no aig muir. Tha tuirbinean aig muir a’ faighinn buannachd bho luaths gaoithe a tha nas àirde agus nas cunbhalaiche.</p><p>Leis gu bheil Breatainn ann an suidheachadh fosgailte san Atlantaig an ear-thuath, ’s e fear de na h-àiteachan as fheàrr air an t-saoghal airson lùth a ghintinn leis a’ ghaoith, agus ann an uisgeachan eu-domhainn a’ Chuain a Tuath tha cuid de na tuathan-gaoithe far-cladaich as motha air an t-saoghal.</p><p>Tha tuirbinean-gaoithe air tìr ann an Sasainn agus sa Chuimrigh (agus cuid ann an Alba) ceangailte ris an lìonra-sgaoilidh ionadail seach an lìonra-sgaoilidh nàiseanta, agus le sin tha ESO a’ Ghriod Nàiseanta dìreach a’ toirt tuairmse air na tha iad a’ gintinn, stèidhichte air an aimsir agus air an iarrtas a tha ri fhaicinn san lìonra. Tha tuirbinean far-cladaich (agus mòran thuirbinean air tìr ann an Alba) ceangailte ris an lìonra sgaoilidh agus tha na tha iad a’ gintinn air a thomhas.</p>',
      Generation::HYDROELECTRIC => '<p>Tha tuirbinean dealan-uisge a’ gintinn cumhachd le sruthadh uisge. Ann an siostaman dealan-uisge mòra tha loch-tasgaidh agus dama, a tha a’ riaghladh na tha de dh’uisge a’ tighinn troimhe. Tha siostaman nas lugha air aibhnichean an urra ri sruthadh caochlaideach na h-aibhne.</p><p>Tha siostaman dealain-uisge mòra a’ cleachdadh topografaidh bheanntan airson nan lochan-tasgaidh agus le sin, tha a’ mhòr-chuid dhiubh ann an Alba, tha àireamh nas lugha anns a’ Chuimrigh, agus tha grunnan ann an Sasainn.</p>'
    ], $demand);

?>
        </section>
        <section id="others">
          <h2><?= Value::formatPercentage($datum->types->get(Types::OTHERS) / $demand) ?>% bunan eile</h2>
<?php

    self::outputTable($datum->generation, [
      Generation::NUCLEAR => '<p>Tha an teas a tha air a dhèanamh nuair a tha ataman uranium air an sgaradh le fisean niuclasach air a chleachdadh ann an stèiseanan-cumhachd niuclasach airson smùid a dhèanamh gus tuirbin a thionndadh. B’ e Calder Hall ann an Cumbria a’ chiad stèisean-cumhachd niuclasach coimeirsealta air an t-saoghal, agus thòisich e a’ dèanamh cumhachd air an 27mh den Lùnastal 1956.</p><p>Tha cumhachd niuclasach connspaideach leis gu bheil cunnart ann gun tèid stuth rèidio-beò a leigeil a-mach le tubaistean. Thachair an tubaist bu mhiosa ann am Breatainn air an 10mh den Dàmhair 1957 nuair a chaidh readhactar aig Windscale (Sellafield an-diugh) ann an Cumbria na theine. A rèir aithris dh’adhbharaich e mu 240 cùis de dh’aillse, agus chaochail dàrna leth nan daoine sin leis. Tha dì-choimiseanadh an làraich a’ dol air adhart.</p><p>Tha prògram niuclasach Bhreatainn air mu 150,000 meatair ciùbach de sgudal rèidio-beò a dhèanamh gu ruige seo agus tha a’ mhòr-chuid dheth air a stòradh ann an goireasan sealach aig Sellafield ann an Cumbria agus aig Dùnrath ann an Alba. Tha planaichean ann airson làrach-stòraidh maireannach a tha domhainn fo thalamh, ach tha e air a bhith doirbh làrach freagarrach a lorg airson sgudal rèidio-beò a stòradh fad 100,000 bliadhna.</p>',
      Generation::BIOMASS => '<p>Tha stèiseanan-cumhachd bith-thomaid a’ losgadh stuth bho lusan airson smùid a dhèanamh gus tuirbinean obrachadh. Bha Drax, an stèisean cumhachd as motha ann am Breatainn, a’ losgadh gual roimhe ach chaidh atharrachadh gus pealaidean fiodha a losgadh.</p><p>Tha stèiseanan-cumhachd bith-thomaid airidh air subsadaidhean lùth ath-nuadhachail (còrr is £6bn mu thràth gu Drax) leis gum bi craobhan òga a’ sùghadh carbon dà-ogsaid a tha air a dhèanamh le losgadh chraobhan aosta. Ach, tha seo a’ toirt deicheadan bhliadhnachan, agus san ùine sin tha a’ bhuaidh air ìrean carbon dà-ogsaid san àile nas miosa na na h-ìrean le losgadh chonnaidhean-fosail.</p>'
    ], $demand);

?>
        </section>
        <section id="transfers">
          <h2><?= Value::formatPercentage($datum->interconnectors->getTotal() / $demand) ?>% eadar-cheanglaichearan</h2>
<?php

    self::outputTable($datum->interconnectors, [
      Interconnectors::BELGIUM     => '<p>Tha aon cheangal eadar Breatainn agus a’ Bheilg:</p><p>Tha Nemo Link na cheangal 1<abbr>GW</abbr> eadar Richborough ann an Sasainn agus Zeebrugge sa Bheilg. Thòisich e ag obair ann an 2019.</p>',
      Interconnectors::DENMARK     => '<p>Tha aon cheangal eadar Breatainn agus an Danmhairg:</p><p>Tha Viking Link na cheangal 1.4<abbr>GW</abbr>  eadar Bicker Fen ann an Sasainn agus Revsing san Danmhairg. Thòisich e ag obair ann an 2023.</p>',
      Interconnectors::FRANCE      => '<p>Tha trì ceanglaichean eadar Breatainn agus an Fhraing:</p><p>Tha IFA (Interconnexion France–Angleterre) na cheangal 2<abbr>GW</abbr> eadar Sellindge ann an Sasainn agus Bonningues-lès-Calais san Fhraing. Thòisich e ag obair ann an 1986.</p><p>Tha IFA-2 (Interconnexion France–Angleterre 2) na cheangal 1<abbr>GW</abbr> eadar Warsash ann an Sasainn agus Tourbe san Fhraing. Thòisich e ag obair ann an 2021.</p><p>Tha ElecLink na cheangal 1<abbr>GW</abbr> eadar Folkestone ann an Sasainn agus Peuplingues san Fhraing, a tha a’ dol tro Thunail a’ Chaolais. Thòisich e ag obair ann an 2022.</p>',
      Interconnectors::IRELAND     => '<p>Bho 2007 tha Poblachd na h-Èireann agus Èirinn a Tuath air a bhith nan aon mhargaidh dealain. Tha dà cheangal eadar Breatainn agus Èirinn: </p><p>Tha Moyle na cheangal 0.5<abbr>GW</abbr> eadar Achadh na Croise ann an Alba agus Ballycronan More ann an Èirinn a Tuath. Thòisich e ag obair ann an 2001.</p><p>Tha EWIC (an t-eadar-cheanglaichear Sear-Siar) na cheangal 0.5<abbr>GW</abbr> eadar  Shotton sa Chuimrigh agus Rush North Beach ann am Poblachd na h-Èireann. Thòisich e ag obair ann an 2012.</p>',
      Interconnectors::NETHERLANDS => '<p>Tha aon cheangal eadar Breatainn agus Na Tìrean Ìseal:</p><p>Tha BritNed na cheangal 1<abbr>GW</abbr> eadar Isle of Grain ann an Sasainn agus Maasvlakte anns Na Tìrean Ìseal. Thòisich e ag obair ann an 2011.</p>',
      Interconnectors::NORWAY      => '<p>Tha aon cheangal eadar Breatainn agus Nirribhidh:</p><p>Tha NSL (Ceangal a’ Chuain a Tuath) na cheangal 1.4<abbr>GW</abbr> eadar Blyth ann an Sasainn agus Kvilldal ann an Nirribhidh. Thòisich e ag obair ann an 2021.</p>'
    ], $demand, true);

?>
        </section>
        <section id="storage">
          <h2><?= Value::formatPercentage($datum->storage->getTotal() / $demand) ?>% stòradh</h2>
<?php

    self::outputTable($datum->storage, [
      Storage::PUMPED_STORAGE => '<p>Bidh siostaman stòraidh a th’ air am pumpadh a’ cleachdadh dealan nuair a tha e cuimseach saor airson uisge a phumpadh bho loch-tasgaidh ìosal gu loch-tasgaidh nas àirde. Nuair a tha prìs an dealain nas àirde, tha an t-uisge air a chleachdadh gus na tuirbinean a thionndadh agus dealan a dhèanamh. Tha luachan neagataibh a’ ciallachadh gu bheilear a’ pumpadh an uisge, agus luachan posataibh gu bheilear a’ gintinn dealan.</p>',
      'battery' => '<p>Bidh siostaman stòraidh le bataraidhean a’ cleachdadh dealan nuair a tha e cuimseach saor airson buidheann bhataraidhean a theàirrdseadh. Nuair a tha an dealan cuimseach daor, bidh an dealan anns na bataraidhean air a chleachdadh.</p><p>Tha grunn shiostaman stòraidh le bataraidhean ann am Breatainn, ach chan eil làn-chunntas ri fhaighinn orra fhathast agus chan eil dàta air stòradh le bataraidhean air a shealltainn air an làrach seo.</p>'
    ], $demand, true);

?>
        </section>
      </div>
<?php
  }

  /**
   * Outputs a table.
   *
   * @param Map           $map         The map
   * @param array<string> $keys        An array mapping keys to help
   * @param float         $demand      The total demand
   * @param bool          $isTransfers Whether the table shows transfers
   */
  private static function outputTable(
    Map   $map,
    array $keys,
    float $demand,
    bool  $isTransfers = false
  ): void {
?>
          <table class="sources<?= ($isTransfers ? ' transfers' : '') ?>">
<?php

    foreach ($keys as $key => $help) {
      echo '            <tr><td class="';
      echo $key;
      echo '"><td>';

      if ($key === 'battery') {
        echo 'Stòradh le bataraidhean';
      } else {
        echo $map::KEYS[$key];
      }

      echo ' <span data-help="';
      echo $help;
      echo '"></span></td><td>';

      if ($key === 'battery') {
        echo '—';
      } else {
        echo Value::formatPower($map->get($key));
      }

      echo '</td><td>';

      if ($key === 'battery') {
        echo '—';
      } else {
        echo Value::formatPercentage($map->get($key) / $demand);
      }

      echo "</td></tr>\n";
    }

?>
          </table>
<?php
  }
}
