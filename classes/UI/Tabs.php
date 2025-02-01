<?php

namespace KateMorley\Grid\UI;

use KateMorley\Grid\State\State;

/** Outputs the tabs. */
class Tabs {
  /**
   * Outputs the tabs.
   *
   * @param State $state The state
   */
  public static function output(State $state): void {
    $axes = new Axes($state);

?>
      <section>
        <div role="tablist">
          <h2 id="tab-day" role="tab" aria-controls="tab-panel-day" aria-selected="true">Latha mu <span>dheireadh</span></h2>
          <h2 id="tab-week" role="tab" aria-controls="tab-panel-week" aria-selected="false">Seachdain mu <span>dheireadh</span></h2>
          <h2 id="tab-year" role="tab" aria-controls="tab-panel-year" aria-selected="false">Bliadhna mu <span>dheireadh</span></h2>
          <h2 id="tab-all" role="tab" aria-controls="tab-panel-all" aria-selected="false"><span>Ùine</span> gu lèir</h2>
        </div>
        <div id="tab-panel-day" role="tabpanel" aria-labelledby="tab-day" tabindex="0">
<?php Panel::output('Past day', $state->pastDay, $state->pastDaySeries, $axes, 12, 'g:ia'); ?>
        </div>
        <div id="tab-panel-week" role="tabpanel" aria-labelledby="tab-week" tabindex="0">
<?php Panel::output('Past week', $state->pastWeek, $state->pastWeekSeries, $axes, 1, 'l'); ?>
        </div>
        <div id="tab-panel-year" role="tabpanel" aria-labelledby="tab-year" tabindex="0">
<?php Panel::output('Past year', $state->pastYear, $state->pastYearSeries, $axes, 13, 'd/m/Y'); ?>
        </div>
        <div id="tab-panel-all" role="tabpanel" aria-labelledby="tab-all" tabindex="0">
<?php Panel::output('All time', $state->allTime, $state->allTimeSeries, $axes, 1, 'Y'); ?>
        </div>
      </section>
<?php
  }
}
