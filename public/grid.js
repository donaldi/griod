const LABELS = {
  price: "Prìs gach MWh",
  emissions: "Eimiseanan gach kWh",
  demand: "Iarrtas",
  generation: "Gintinn",
  fossils: "Connaidhean-fosail",
  renewables: "Ath-nuadhachail",
  others: "Bunan eile",
  transfers: "Aiseag lùth",
  coal: "Gual",
  gas: "Gas",
  solar: "Grèine",
  wind: "Gaoth",
  hydro: "Dealan-uisge",
  nuclear: "Niuclasach",
  biomass: "Bith-thomad",
  belgium: "A’ Bheilg",
  denmark: "An Danmhairg",
  france: "An Fhraing",
  ireland: "Èirinn",
  netherlands: "Na Tìrean Ìseal",
  norway: "Nirribhidh",
  pumped: "Stòradh le pumpadh",
};

const KEY_MARGIN = 8;

const IDS_TO_UPDATE = [
  "status",
  "latest",
  "tab-panel-day",
  "tab-panel-week",
  "tab-panel-year",
  "tab-panel-all",
  "transition",
];

let key = document.createElement("div");
let dialog = document.querySelector("dialog");
let delay = Math.random() * 60000;
let parser = new DOMParser();

document.addEventListener("visibilitychange", update);
document.body.addEventListener("click", handleClick);

let tabList = document.querySelector('[role="tablist"]');
selectTab(tabList, tabList.firstElementChild);
tabList.addEventListener("click", handleTabClick);
tabList.addEventListener("keydown", handleTabKeyDown);

addGraphListeners();
scheduleUpdate();

// Adds the listeners to the graphs
function addGraphListeners() {
  document.querySelectorAll(".pie-chart").forEach((pieChart) => {
    pieChart.addEventListener("mouseover", (e) => updatePieChartKey(e, true));
    pieChart.addEventListener("mouseout", (e) => updatePieChartKey(e, false));
  });

  document.querySelectorAll(".graph svg").forEach((graph) => {
    graph.addEventListener("mouseover", showGraphKey);
    graph.addEventListener("mouseleave", hideGraphKey);
  });
}

// Handles a click by showing a help dialog if appropriate
function handleClick(e) {
  let help = e.target.dataset.help;

  if (help) {
    dialog.children[0].innerHTML = e.target.parentNode.textContent;
    dialog.children[2].innerHTML = help;
    dialog.showModal();
  }
}

// Updates a pie chart key
function updatePieChartKey(e, showDetails) {
  if (e.target.nodeName === "path") {
    let sourceNode = e.target.parentNode;
    let source = "generation";
    let pieChart = sourceNode.parentNode;

    if (showDetails) {
      sourceNode = e.target;
      source = e.target.getAttribute("class");
    }

    let nodes = pieChart.querySelectorAll("div,span");

    nodes[1].textContent = LABELS[source];
    nodes[2].className = source;
    nodes[4].textContent = sourceNode.dataset.power;
    nodes[6].textContent = sourceNode.dataset.percentage;
  }
}

// Selects a tab
function selectTab(tabList, tab) {
  let panels = Array.from(
    tabList.parentNode.querySelectorAll('[role="tabpanel"]'),
  );

  for (let node of tabList.children) {
    let selected = node === tab;

    node.setAttribute("aria-selected", selected ? "true" : "false");
    node.tabIndex = selected ? 0 : -1;

    panels.shift().style.display = selected ? "grid" : "none";
  }
}

// Handles a click on a tab
function handleTabClick(e) {
  if (e.target.parentNode === this) {
    selectTab(this, e.target);
  } else if (e.target.parentNode.parentNode === this) {
    selectTab(this, e.target.parentNode);
  }
}

// Handles a key down on a tab
function handleTabKeyDown(e) {
  let tabs = Array.from(this.children);
  let count = tabs.length;
  let index = tabs.indexOf(this.querySelector('[aria-selected="true"'));

  let preventDefault = true;

  switch (e.key) {
    case "ArrowLeft":
      index = (index + count - 1) % count;
      break;
    case "ArrowRight":
      index = (index + 1) % count;
      break;
    case "Home":
      index = 0;
      break;
    case "End":
      index = count - 1;
      break;
    default:
      preventDefault = false;
  }

  if (preventDefault) {
    e.preventDefault();
  }

  selectTab(this, tabs[index]);
  tabs[index].focus();
}

// Shows the graph key
function showGraphKey(e) {
  if (e.target.nodeName !== "rect") {
    return;
  }

  let graph = e.target.parentNode.parentNode;
  let transfers = graph.dataset.transfers === "true";
  let prefix = graph.dataset.prefix;
  let suffix = graph.dataset.suffix;
  let classes = Array.from(graph.querySelectorAll("polyline")).map(
    (series) => series.className.baseVal,
  );
  let values = e.target.dataset.values.split(" ");

  let time = document.createElement("div");
  time.append(e.target.dataset.time);

  let table = document.createElement("table");
  table.className = "sources" + (transfers ? " transfers" : "");

  let body = table.createTBody();

  for (let i = 0; i < values.length; i++) {
    let isNegative = values[i].substring(0, 1) === "-";

    let row = body.insertRow();
    row.insertCell().className = classes[i];
    row.insertCell().textContent = LABELS[classes[i]];
    row.insertCell().textContent =
      (isNegative ? "−" : "") +
      prefix +
      values[i].substring(isNegative ? 1 : 0) +
      suffix;
  }

  key.innerHTML = "";
  key.append(time, table);
  graph.append(key);

  let keyWidth = key.offsetWidth;
  let overlayPosition = e.target.getBoundingClientRect();

  let left = overlayPosition.left - graph.getBoundingClientRect().left;

  if (overlayPosition.left > keyWidth + 2 * KEY_MARGIN) {
    left -= keyWidth + KEY_MARGIN;
  } else {
    left += overlayPosition.width + KEY_MARGIN;
  }

  key.style.left = left + "px";
}

// Hides the graph key
function hideGraphKey() {
  key.remove();
}

// Schedules an update. Updates occur every five minutes, with an offset of two
// minutes plus a visitor-specific random delay of up to a minute to reduce
// server load.
function scheduleUpdate() {
  setTimeout(update, (420000 - (Date.now() % 300000) + delay) % 300000);
}

// Updates the user interface. The 'unscheduled' flag is used for updates
// triggered when the page becomes visible again after updates were suspended
// while the page was not visible.
function update(unscheduled) {
  let time = Math.floor(Date.now() / 300000);

  if (unscheduled && Date.now() % 300000 < 120000 + delay) {
    time--;
  }

  document.querySelector('link[type*="svg"]').href = "favicon.svg?" + time;

  if (document.visibilityState === "visible") {
    fetch("?v=" + time)
      .then((response) => response.text())
      .then((html) => {
        let update = parser.parseFromString(html, "text/html");

        IDS_TO_UPDATE.forEach((id) =>
          document
            .getElementById(id)
            .replaceChildren(...update.getElementById(id).children),
        );

        hideGraphKey();

        addGraphListeners();
      });
  }

  if (!unscheduled) {
    scheduleUpdate();
  }
}
