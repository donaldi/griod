<?php


namespace KateMorley\Grid\UI;

use KateMorley\Grid\State\State;

/** Outputs the user interface. */
class UI {
  /**
   * Outputs the user interface.
   *
   * @param State $state The state
   */
  public static function output(State $state): void {
?>
<!DOCTYPE html>
<html lang="en-gb">
  <head>
    <title>
      An Griod Nàiseanta: Beò
    </title>
    <meta name="description" content="Shows the live status of Great Britain’s electric power transmission network in Scottish Gaelic">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="fediverse:creator" content="@kate@fosstodon.org">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="National Grid: Live">
    <meta name="twitter:description" content="Shows the live status of Great Britain’s electric power transmission network in Scottish Gaelic">
    <meta name="twitter:image" content="https://grid.iamkate.com/banner.png">
    <meta name="twitter:site" content="@KateRoseMorley">
    <meta property="og:url" content="https://grid.iamkate.com/">
    <meta property="og:type" content="website">
    <meta property="og:title" content="National Grid: Live">
    <meta property="og:image" content="https://grid.iamkate.com/banner.png">
    <link rel="canonical" href="https://grid.iamkate.com/">
    <link rel="preload" href="proza-regular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="proza-light.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="grid.css?<?= filemtime(__DIR__ . '/../../public/grid.css') ?>" type="text/css">
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="icon" href="favicon.svg?<?= floor(time() / 300) ?>" type="image/svg+xml">
    <script src="grid.js?<?= filemtime(__DIR__ . '/../../public/grid.js') ?>" defer></script>
  </head>
  <body>
   <main>
      <section id="introduction">
        <h1>
          An Griod Nàiseanta: Beò
        </h1>
        <p>
          ’S e an Griod Nàiseanta an lìonra a tha a’ sgaoileadh dealan air feadh Bhreatainn (dàta ga ùrachadh gach 5 mionaidean) 
        </p>
      </section>
      <div id="status" class="columns">
        <section>
<?php Status::output($state->latest, Status::time($state->time), true); ?>
        </section>
        <section>
<?php Equation::output($state->latest, true); ?>
        </section>
      </div>
<?php Latest::output($state->latest); ?>
<?php Tabs::output($state); ?>
      <div class="columns">
<?php Transition::output($state); ?>
<?php About::output($state); ?>
      </div>
    </main>
   <dialog>
      <h2></h2>
      <form method="dialog"><button><svg viewBox="0 0 30 30"><path d="M6,6 24,24"/><path d="M6,24 24,6"/></svg></button></form>
      <div></div>
    </dialog>
  </body>
</html>
<?php
  }
}
