"use strict";

var draw = Chart.controllers.line.prototype.draw;
Chart.controllers.lineShadow = Chart.controllers.line.extend({
  draw: function () {
    draw.apply(this, arguments);
    var ctx = this.chart.chart.ctx;
    var _stroke = ctx.stroke;
    ctx.stroke = function () {
      ctx.save();
      ctx.shadowColor = "#00000075";
      ctx.shadowBlur = 10;
      ctx.shadowOffsetX = 8;
      ctx.shadowOffsetY = 8;
      _stroke.apply(this, arguments);
      ctx.restore();
    };
  },
});

new Chart(document.getElementById("myChart"), {
  type: "bar",
  data: {
    labels: ["2010", "2011", "2012", "2013", "2014"],
    datasets: [
      {
        label: "Population (millions)",
        backgroundColor: [
          "#3e95cd",
          "#8e5ea2",
          "#3cba9f",
          "#e8c3b9",
          "#c45850",
        ],
        data: [50, 45, 62, 55, 43],
      },
    ],
  },
  options: {
    legend: { display: false },
    title: {
      display: true,
      text: "Predicted Profit in millions",
    },
    scales: {
      yAxes: [
        {
          ticks: {
            fontColor: "#9aa0ac", // Font Color
          },
        },
      ],
      xAxes: [
        {
          ticks: {
            fontColor: "#9aa0ac", // Font Color
          },
        },
      ],
    },
  },
});

new Chart(document.getElementById("myChart2"), {
  type: "bar",
  data: {
    labels: ["1900", "1950", "1999", "2050"],
    datasets: [
      {
        label: "Africa",
        backgroundColor: "#3e95cd",
        data: [133, 221, 783, 2478],
      },
      {
        label: "Europe",
        backgroundColor: "#8e5ea2",
        data: [408, 547, 675, 734],
      },
    ],
  },
  options: {
    title: {
      display: true,
      text: "Population growth (millions)",
    },
    scales: {
      yAxes: [
        {
          ticks: {
            fontColor: "#9aa0ac", // Font Color
          },
        },
      ],
      xAxes: [
        {
          ticks: {
            fontColor: "#9aa0ac", // Font Color
          },
        },
      ],
    },
  },
});

var ctx = document.getElementById("myChart3").getContext("2d");
var myChart = new Chart(ctx, {
  type: "doughnut",
  data: {
    datasets: [
      {
        data: [80, 50, 40, 30, 20],
        backgroundColor: [
          "#191d21",
          "#63ed7a",
          "#ffa426",
          "#fc544b",
          "#6777ef",
        ],
        label: "Dataset 1",
      },
    ],
    labels: ["Black", "Green", "Yellow", "Red", "Blue"],
  },
  options: {
    responsive: true,
    legend: {
      position: "bottom",
    },
  },
});

var ctx = document.getElementById("myChart4").getContext("2d");
var myChart = new Chart(ctx, {
  type: "pie",
  data: {
    datasets: [
      {
        data: [80, 50, 40, 30, 100],
        backgroundColor: [
          "#191d21",
          "#63ed7a",
          "#ffa426",
          "#fc544b",
          "#6777ef",
        ],
        label: "Dataset 1",
      },
    ],
    labels: ["Black", "Green", "Yellow", "Red", "Blue"],
  },
  options: {
    responsive: true,
    legend: {
      position: "bottom",
    },
  },
});

var ctx = document.getElementById("line-chart");
if (ctx) {
  ctx.height = 150;
  var myChart = new Chart(ctx, {
    type: "lineShadow",
    data: {
      labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
      type: "line",
      defaultFontFamily: "Poppins",
      datasets: [
        {
          label: "Foods",
          data: [0, 30, 10, 120, 50, 63, 10],
          backgroundColor: "transparent",
          borderColor: "#222222",
          borderWidth: 3,
          pointStyle: "circle",
          pointRadius: 3,
          pointBorderColor: "transparent",
          pointBackgroundColor: "#222222",
        },
        {
          label: "Electronics",
          data: [0, 50, 40, 80, 40, 79, 120],
          backgroundColor: "transparent",
          borderColor: "#f96332",
          borderWidth: 3,
          pointStyle: "circle",
          pointRadius: 3,
          pointBorderColor: "transparent",
          pointBackgroundColor: "#f96332",
        },
      ],
    },
    options: {
      responsive: true,
      tooltips: {
        mode: "index",
        titleFontSize: 12,
        titleFontColor: "#fff",
        bodyFontColor: "#fff",
        backgroundColor: "#000",
        titleFontFamily: "Poppins",
        bodyFontFamily: "Poppins",
        cornerRadius: 3,
        intersect: false,
      },
      legend: {
        display: false,
        labels: {
          usePointStyle: true,
          fontFamily: "Poppins",
        },
      },
      scales: {
        xAxes: [
          {
            display: true,
            scaleLabel: {
              display: false,
              labelString: "Month",
            },
            ticks: {
              fontFamily: "Poppins",
              fontColor: "#9aa0ac", // Font Color
            },
          },
        ],
        yAxes: [
          {
            display: true,
            scaleLabel: {
              display: true,
              labelString: "Value",
              fontFamily: "Poppins",
            },
            ticks: {
              fontFamily: "Poppins",
              fontColor: "#9aa0ac", // Font Color
            },
          },
        ],
      },
      title: {
        display: false,
        text: "Normal Legend",
      },
    },
  });
}

var ctx = document.getElementById("areaChart");
if (ctx) {
  ctx.height = 150;
  var myChart = new Chart(ctx, {
    type: "line",
    data: {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [
        {
          label: "My First dataset",
          borderColor: "rgba(0,0,0,.09)",
          borderWidth: "3",
          backgroundColor: "rgba(255,128,0,.4)",
          data: [22, 44, 67, 43, 76, 45, 12],
        },
        {
          label: "My Second dataset",
          borderColor: "rgba(0, 123, 255, 0.9)",
          borderWidth: "1",
          backgroundColor: "rgba(0, 123, 255, 0.5)",
          pointHighlightStroke: "rgba(26,179,148,1)",
          data: [16, 32, 18, 26, 42, 33, 44],
        },
      ],
    },
    options: {
      legend: {
        position: "top",
        labels: {},
      },
      responsive: true,
      tooltips: {
        mode: "index",
        intersect: false,
      },
      hover: {
        mode: "nearest",
        intersect: true,
      },
      scales: {
        xAxes: [
          {
            ticks: {
              fontColor: "#9aa0ac", // Font Color
            },
          },
        ],
        yAxes: [
          {
            ticks: {
              beginAtZero: true,
              fontColor: "#9aa0ac", // Font Color
            },
          },
        ],
      },
    },
  });
}

//radar chart
var ctx = document.getElementById("radar-chart");
if (ctx) {
  ctx.height = 200;
  var myChart = new Chart(ctx, {
    type: "radar",
    data: {
      labels: [
        ["Eating", "Dinner"],
        ["Drinking", "Water"],
        "Sleeping",
        ["Designing", "Graphics"],
        "Coding",
        "Cycling",
        "Running",
      ],
      datasets: [
        {
          label: "My First dataset",
          data: [65, 59, 66, 45, 56, 55, 40],
          borderColor: "rgba(0, 123, 255, 0.6)",
          borderWidth: "1",
          backgroundColor: "rgba(0, 123, 255, 0.4)",
        },
        {
          label: "My Second dataset",
          data: [28, 12, 40, 19, 63, 27, 87],
          borderColor: "rgba(0, 123, 255, 0.7",
          borderWidth: "1",
          backgroundColor: "rgba(0, 123, 255, 0.5)",
        },
      ],
    },
    options: {
      legend: {
        position: "top",
        labels: {},
      },
      scale: {
        ticks: {
          beginAtZero: true,
        },
      },
    },
  });
}

var ctx = document.getElementById("polar-chart");
if (ctx) {
  ctx.height = 200;
  var myChart = new Chart(ctx, {
    type: "polarArea",
    data: {
      datasets: [
        {
          data: [15, 18, 9, 6, 19],
          backgroundColor: [
            "rgba(0, 123, 255,0.9)",
            "rgba(0, 123, 255,0.8)",
            "rgba(0, 123, 255,0.7)",
            "rgba(0,0,0,0.2)",
            "rgba(0, 123, 255,0.5)",
          ],
        },
      ],
      labels: ["Green", "Green", "Green", "Green"],
    },
    options: {
      legend: {
        position: "top",
        labels: {
          fontFamily: "Poppins",
          fontColor: "#9aa0ac", // Font Color
        },
      },
      responsive: true,
    },
  });
}

var ctx = document.getElementById("line-chart3").getContext("2d");

var gradientStroke = ctx.createLinearGradient(500, 0, 0, 0);
gradientStroke.addColorStop(0, "rgba(155, 89, 182, 1)");
gradientStroke.addColorStop(1, "rgba(231, 76, 60, 1)");

var myChart = new Chart(ctx, {
  type: "lineShadow",
  data: {
    labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
    type: "line",
    defaultFontFamily: "Poppins",
    datasets: [
      {
        label: "Foods",
        data: [0, 30, 10, 120, 50, 63, 10],
        borderColor: gradientStroke,
        pointBorderColor: gradientStroke,
        pointBackgroundColor: gradientStroke,
        pointHoverBackgroundColor: gradientStroke,
        pointHoverBorderColor: gradientStroke,
        pointBorderWidth: 10,
        pointHoverRadius: 10,
        pointHoverBorderWidth: 1,
        pointRadius: 1,
        fill: false,
        borderWidth: 4,
      },
      {
        label: "Electronics",
        data: [0, 50, 40, 80, 40, 79, 120],
        borderColor: gradientStroke,
        pointBorderColor: gradientStroke,
        pointBackgroundColor: gradientStroke,
        pointHoverBackgroundColor: gradientStroke,
        pointHoverBorderColor: gradientStroke,
        pointBorderWidth: 10,
        pointHoverRadius: 10,
        pointHoverBorderWidth: 1,
        pointRadius: 1,
        fill: false,
        borderWidth: 4,
      },
    ],
  },
  options: {
    legend: {
      position: "bottom",
    },
    tooltips: {
      mode: "index",
      titleFontSize: 12,
      titleFontColor: "#fff",
      bodyFontColor: "#fff",
      backgroundColor: "#000",
      titleFontFamily: "Poppins",
      bodyFontFamily: "Poppins",
      cornerRadius: 3,
      intersect: false,
    },
    scales: {
      yAxes: [
        {
          ticks: {
            fontColor: "#9aa0ac", // Font Color
            fontStyle: "bold",
            beginAtZero: true,
            maxTicksLimit: 5,
            padding: 20,
          },
          gridLines: {
            drawTicks: false,
            display: false,
          },
        },
      ],
      xAxes: [
        {
          gridLines: {
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9aa0ac", // Font Color
            fontStyle: "bold",
          },
        },
      ],
    },
  },
});

var ctx = document.getElementById("line-chart4").getContext("2d");

var gradientStroke = ctx.createLinearGradient(0, 0, 700, 0);
gradientStroke.addColorStop(0, "rgba(255, 204, 128, 1)");
gradientStroke.addColorStop(0.5, "rgba(255, 152, 0, 1)");
gradientStroke.addColorStop(1, "rgba(239, 108, 0, 1)");

var gradientStroke2 = ctx.createLinearGradient(0, 0, 700, 0);
gradientStroke2.addColorStop(0, "rgba(0, 204, 102, 1)");
gradientStroke2.addColorStop(0.5, "rgba(11, 230, 120, 1)");
gradientStroke2.addColorStop(1, "rgba(11, 230, 120, 1)");

var myChart = new Chart(ctx, {
  type: "lineShadow",
  data: {
    labels: ["2010", "2011", "2012", "2013", "2014", "2015", "2016"],
    type: "line",
    defaultFontFamily: "Poppins",
    datasets: [
      {
        label: "Foods",
        data: [0, 30, 10, 120, 50, 63, 10],
        borderColor: gradientStroke,
        pointBorderColor: gradientStroke,
        pointBackgroundColor: gradientStroke,
        pointHoverBackgroundColor: gradientStroke,
        pointHoverBorderColor: gradientStroke,
        pointBorderWidth: 5,
        pointHoverRadius: 5,
        pointHoverBorderWidth: 1,
        pointRadius: 1,
        fill: false,
        borderWidth: 4,
      },
      {
        label: "Electronics",
        data: [0, 50, 40, 80, 40, 79, 120],
        borderColor: gradientStroke2,
        pointBorderColor: gradientStroke2,
        pointBackgroundColor: gradientStroke2,
        pointHoverBackgroundColor: gradientStroke2,
        pointHoverBorderColor: gradientStroke2,
        pointBorderWidth: 5,
        pointHoverRadius: 5,
        pointHoverBorderWidth: 1,
        pointRadius: 1,
        fill: false,
        borderWidth: 4,
      },
    ],
  },

  options: {
    legend: {
      position: "bottom",
    },
    scales: {
      yAxes: [
        {
          ticks: {
            fontColor: "#9aa0ac", // Font Color
            fontStyle: "bold",
            beginAtZero: true,
            maxTicksLimit: 5,
            padding: 20,
          },
          gridLines: {
            drawTicks: false,
            display: false,
          },
        },
      ],
      xAxes: [
        {
          gridLines: {
            zeroLineColor: "transparent",
          },
          ticks: {
            padding: 20,
            fontColor: "#9aa0ac", // Font Color
            fontStyle: "bold",
          },
        },
      ],
    },
  },
});
