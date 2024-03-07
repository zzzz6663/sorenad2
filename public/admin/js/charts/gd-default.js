!(function (NioApp, $) {
    "use strict";

    //////// for developer - User Balance //////// 
    // Avilable options to pass from outside 
    // labels: array,
    // legend: false - boolean,
    // dataUnit: string, (Used in tooltip or other section for display) 
    // datasets: [{label : string, color: string (color code with # or other format), data: array}]
    var profileBalance = {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
        dataUnit: 'بیت کوین',
        lineTension: 0.15,
        datasets: [{
            label: "مجموع دریافت شده",
            color: "#733AEA",
            background: NioApp.hexRGB('#733AEA', .3),
            data: [111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 75, 90]
        }]
    };

    function lineProfileBalance(selector, set_data) {
        var $selector = (selector) ? $(selector) : $('.profile-balance-chart');
        $selector.each(function () {
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;
            var selectCanvas = document.getElementById(_self_id).getContext("2d");

            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension: _get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth: 2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: "transparent",
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 2,
                    pointRadius: 3,
                    pointHitRadius: 3,
                    data: _get_data.datasets[i].data,
                });
            }
            var chart = new Chart(selectCanvas, {
                type: 'line',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: false,
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function (tooltipItem, data) {
                                return false;
                            },
                            label: function (tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFontSize: 11,
                        titleFontColor: '#6783b8',
                        titleFontFamily: 'YekanBakhFaNum',
                        titleMarginBottom: 4,
                        bodyFontColor: '#9eaecf',
                        bodyFontSize: 10,
                        bodyFontFamily: 'YekanBakhFaNum',
                        bodySpacing: 3,
                        yPadding: 8,
                        xPadding: 8,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: false,
                        }],
                        xAxes: [{
                            display: false,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }]
                    }
                }
            });
        })
    }

    // init chart
    NioApp.coms.docReady.push(function () { lineProfileBalance(); });

    var orderOverview = {
        labels: ["22 شهریور", "23 شهریور", "24 شهریور", "25 شهریور", "26 شهریور", "27 شهریور", "28 شهریور", "29 شهریور", "30 شهریور", "01 مهر"],
        dataUnit: 'تومان',
        datasets: [{
            label: "خرید سفارشات",
            color: "#8feac5",
            data: [1820, 1200, 1600, 2500, 1820, 1200, 1700, 1820, 1400, 2100]
        }, {
            label: "فروش سفارشات",
            color: "#9C73F5",
            data: [3000, 3450, 2450, 1820, 2700, 4870, 2470, 2600, 4000, 2380]
        }]
    };

    function orderOverviewChart(selector, set_data) {
        var $selector = (selector) ? $(selector) : $('.order-overview-chart');
        $selector.each(function () {
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data,
                _d_legend = (typeof _get_data.legend === 'undefined') ? false : _get_data.legend;

            var selectCanvas = document.getElementById(_self_id).getContext("2d");
            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    // Styles
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: 'transparent',
                    hoverBorderColor: 'transparent',
                    borderSkipped: 'bottom',
                    barPercentage: .8,
                    categoryPercentage: .6
                });
            }
            var chart = new Chart(selectCanvas, {
                type: 'bar',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            fontColor: '#6783b8',
                            fontFamily: 'YekanBakhFaNum',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function (tooltipItem, data) {
                                return data.datasets[tooltipItem[0].datasetIndex].label;
                            },
                            label: function (tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFontSize: 13,
                        titleFontColor: '#6783b8',
                        titleFontFamily: 'YekanBakhFaNum',
                        titleMarginBottom: 6,
                        bodyFontColor: '#9eaecf',
                        bodyFontFamily: 'YekanBakhFaNum',
                        bodyFontSize: 12,
                        bodySpacing: 4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            position: NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                beginAtZero: true,
                                fontSize: 11,
                                fontColor: '#9eaecf',
                                fontFamily: 'YekanBakhFaNum',
                                padding: 10,
                                callback: function (value, index, values) {
                                    return value + ' تومان';
                                },
                                min: 100,
                                max: 5000,
                                stepSize: 1200
                            },
                            gridLines: {
                                color: NioApp.hexRGB("#526484", .2),
                                tickMarkLength: 0,
                                zeroLineColor: NioApp.hexRGB("#526484", .2)
                            },

                        }],
                        xAxes: [{
                            display: true,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                fontSize: 9,
                                fontColor: '#9eaecf',
                                fontFamily: 'YekanBakhFaNum',
                                source: 'auto',
                                padding: 10,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 0,
                                zeroLineColor: 'transparent',
                            },
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function () { orderOverviewChart(); });

    var userActivity = {
        labels: ["01 بهمن", "02 بهمن", "03 بهمن", "04 بهمن", "05 بهمن", "06 بهمن", "07 بهمن", "08 بهمن", "09 بهمن", "10 بهمن", "11 بهمن", "12 بهمن", "13 بهمن", "14 بهمن", "15 بهمن", "16 بهمن", "17 بهمن", "18 بهمن", "19 بهمن", "20 بهمن", "21 بهمن"],
        dataUnit: 'تومان',
        stacked: true,
        datasets: [{
            label: "عضویت مستقیم",
            color: "#9C73F5",
            data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90]
        }, {
            label: "عضویت ارجاعی",
            color: NioApp.hexRGB("#9C73F5", .2),
            data: [125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 90]
        }]
    };

    function userActivityChart(selector, set_data) {
        var $selector = (selector) ? $(selector) : $('.usera-activity-chart');
        $selector.each(function () {
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data,
                _d_legend = (typeof _get_data.legend === 'undefined') ? false : _get_data.legend;

            var selectCanvas = document.getElementById(_self_id).getContext("2d");
            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    // Styles
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: 'transparent',
                    hoverBorderColor: 'transparent',
                    borderSkipped: 'bottom',
                    barPercentage: .7,
                    categoryPercentage: .7
                });
            }
            var chart = new Chart(selectCanvas, {
                type: 'bar',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            fontColor: '#6783b8',
                            fontFamily: 'YekanBakhFaNum',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function (tooltipItem, data) {
                                return data.datasets[tooltipItem[0].datasetIndex].label;
                            },
                            label: function (tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFontSize: 13,
                        titleFontColor: '#6783b8',
                        titleFontFamily: 'YekanBakhFaNum',
                        titleMarginBottom: 6,
                        bodyFontColor: '#9eaecf',
                        bodyFontFamily: 'YekanBakhFaNum',
                        bodyFontSize: 12,
                        bodySpacing: 4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: false,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            display: false,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function () { userActivityChart(); });

    var coinOverview = {
        labels: ["بیت کوین", "اتریوم", "NioCoin", "لایت کوین", "بیت کوین"],
        stacked: true,
        datasets: [{
            label: "خرید سفارشات",
            color: ["#f98c45", "#6baafe", "#8feac5", "#6b79c8", "#79f1dc"],
            data: [1740, 2500, 1820, 1200, 1600, 2500]
        }, {
            label: "فروش سفارشات",
            color: [NioApp.hexRGB('#f98c45', .2), NioApp.hexRGB('#6baafe', .4), NioApp.hexRGB('#8feac5', .4), NioApp.hexRGB('#6b79c8', .4), NioApp.hexRGB('#79f1dc', .4)],
            data: [2420, 1820, 3000, 5000, 2450, 1820]
        }]
    };

    function coinOverviewChart(selector, set_data) {
        var $selector = (selector) ? $(selector) : $('.coin-overview-chart');
        $selector.each(function () {
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data,
                _d_legend = (typeof _get_data.legend === 'undefined') ? false : _get_data.legend;

            var selectCanvas = document.getElementById(_self_id).getContext("2d");
            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    // Styles
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: 'transparent',
                    hoverBorderColor: 'transparent',
                    borderSkipped: 'bottom',
                    barThickness: '8',
                    categoryPercentage: 0.5,
                    barPercentage: 1.0
                });
            }
            var chart = new Chart(selectCanvas, {
                type: 'horizontalBar',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            fontColor: '#6783b8',
                            fontFamily: 'YekanBakhFaNum',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function (tooltipItem, data) {
                                return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function (tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + data.datasets[tooltipItem.datasetIndex]['label'];
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFontSize: 13,
                        titleFontColor: '#6783b8',
                        titleFontFamily: 'YekanBakhFaNum',
                        titleMarginBottom: 6,
                        bodyFontColor: '#9eaecf',
                        bodyFontFamily: 'YekanBakhFaNum',
                        bodyFontSize: 12,
                        bodySpacing: 4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: false,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                beginAtZero: true,
                                padding: 0,
                            },
                            gridLines: {
                                color: NioApp.hexRGB("#526484", .2),
                                tickMarkLength: 0,
                                zeroLineColor: NioApp.hexRGB("#526484", .2)
                            },

                        }],
                        xAxes: [{
                            display: false,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                fontSize: 9,
                                fontColor: '#9eaecf',
                                fontFamily: 'YekanBakhFaNum',
                                source: 'auto',
                                padding: 0,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 0,
                                zeroLineColor: 'transparent',
                            },
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function () { coinOverviewChart(); });


    var salesRevenue = {
        labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
        dataUnit: 'تومان',
        stacked: true,
        datasets: [{
            label: "درآمد فروش",
            color: [NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), "#733AEA"],
            data: [11000, 8000, 12500, 5500, 9500, 14299, 11000, 8000, 12500, 5500, 9500, 14299]
        }]
    };

    var activeSubscription = {
        labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور"],
        dataUnit: 'تومان',
        stacked: true,
        datasets: [{
            label: "کاربر فعال",
            color: [NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), "#733AEA"],
            data: [8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };

    var totalSubscription = {
        labels: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور"],
        dataUnit: 'تومان',
        stacked: true,
        datasets: [{
            label: "کاربر فعال",
            color: [NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), NioApp.hexRGB("#aea1ff", .2), "#aea1ff"],
            data: [8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };

    function salesBarChart(selector, set_data) {
        var $selector = (selector) ? $(selector) : $('.sales-bar-chart');
        $selector.each(function () {
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data,
                _d_legend = (typeof _get_data.legend === 'undefined') ? false : _get_data.legend;

            var selectCanvas = document.getElementById(_self_id).getContext("2d");
            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    // Styles
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: 'transparent',
                    hoverBorderColor: 'transparent',
                    borderSkipped: 'bottom',
                    barPercentage: .7,
                    categoryPercentage: .7
                });
            }
            var chart = new Chart(selectCanvas, {
                type: 'bar',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            fontColor: '#6783b8',
                            fontFamily: 'YekanBakhFaNum',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function (tooltipItem, data) {
                                return false;
                            },
                            label: function (tooltipItem, data) {
                                return data['labels'][tooltipItem['index']] + ' ' + data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']];
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFontSize: 11,
                        titleFontColor: '#6783b8',
                        titleFontFamily: 'YekanBakhFaNum',
                        titleMarginBottom: 4,
                        bodyFontColor: '#9eaecf',
                        bodyFontSize: 10,
                        bodyFontFamily: 'YekanBakhFaNum',
                        bodySpacing: 3,
                        yPadding: 8,
                        xPadding: 8,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: false,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            display: false,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function () { salesBarChart(); });

    var salesOverview = {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
        dataUnit: 'بیت کوین',
        lineTension: 0.1,
        datasets: [{
            label: "نمای کلی فروش",
            color: "#733AEA",
            background: NioApp.hexRGB('#733AEA', .3),
            data: [8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };

    function lineSalesOverview(selector, set_data) {
        var $selector = (selector) ? $(selector) : $('.sales-overview-chart');
        $selector.each(function () {
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;
            var selectCanvas = document.getElementById(_self_id).getContext("2d");

            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension: _get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth: 2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: "transparent",
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 2,
                    pointRadius: 3,
                    pointHitRadius: 3,
                    data: _get_data.datasets[i].data,
                });
            }
            var chart = new Chart(selectCanvas, {
                type: 'line',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            fontColor: '#6783b8',
                            fontFamily: 'YekanBakhFaNum',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function (tooltipItem, data) {
                                return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function (tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFontSize: 13,
                        titleFontColor: '#6783b8',
                        titleFontFamily: 'YekanBakhFaNum',
                        titleMarginBottom: 6,
                        bodyFontColor: '#9eaecf',
                        bodyFontFamily: 'YekanBakhFaNum',
                        bodyFontSize: 12,
                        bodySpacing: 4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            position: NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                beginAtZero: true,
                                fontSize: 11,
                                fontColor: '#9eaecf',
                                fontFamily: 'YekanBakhFaNum',
                                padding: 10,
                                callback: function (value, index, values) {
                                    return value + ' تومان';
                                },
                                min: 100,
                                stepSize: 3000
                            },
                            gridLines: {
                                color: NioApp.hexRGB("#526484", .2),
                                tickMarkLength: 0,
                                zeroLineColor: NioApp.hexRGB("#526484", .2)
                            },

                        }],
                        xAxes: [{
                            display: true,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                fontSize: 9,
                                fontColor: '#9eaecf',
                                fontFamily: 'YekanBakhFaNum',
                                source: 'auto',
                                padding: 10,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 0,
                                zeroLineColor: 'transparent',
                            },
                        }]
                    }
                }
            });
        })
    }

    // init chart
    NioApp.coms.docReady.push(function () { lineSalesOverview(); });

    var supportStatus = {
        labels: ["بیت کوین", "اتریوم", "NioCoin", "درخواست ویژگی", "رفع اشکال"],
        stacked: true,
        datasets: [{
            label: "حل شده",
            color: ["#f98c45", "#6baafe", "#8feac5", "#6b79c8", "#79f1dc"],
            data: [66, 74, 92, 142, 189]
        }, {
            label: "باز",
            color: [NioApp.hexRGB('#f98c45', .4), NioApp.hexRGB('#6baafe', .4), NioApp.hexRGB('#8feac5', .4), NioApp.hexRGB('#6b79c8', .4), NioApp.hexRGB('#79f1dc', .4)],
            data: [66, 74, 92, 32, 26]
        }, {
            label: "در انتظار",
            color: [NioApp.hexRGB('#f98c45', .2), NioApp.hexRGB('#6baafe', .2), NioApp.hexRGB('#8feac5', .2), NioApp.hexRGB('#6b79c8', .2), NioApp.hexRGB('#79f1dc', .2)],
            data: [66, 74, 92, 21, 9]
        }]
    };

    function supportStatusChart(selector, set_data) {
        var $selector = (selector) ? $(selector) : $('.support-status-chart');
        $selector.each(function () {
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data,
                _d_legend = (typeof _get_data.legend === 'undefined') ? false : _get_data.legend;

            var selectCanvas = document.getElementById(_self_id).getContext("2d");
            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    // Styles
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: 'transparent',
                    hoverBorderColor: 'transparent',
                    borderSkipped: 'bottom',
                    barThickness: '8',
                    categoryPercentage: 0.5,
                    barPercentage: 1.0
                });
            }
            var chart = new Chart(selectCanvas, {
                type: 'horizontalBar',
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data,
                },
                options: {
                    legend: {
                        display: (_get_data.legend) ? _get_data.legend : false,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            fontColor: '#6783b8',
                            fontFamily: 'YekanBakhFaNum',
                        }
                    },
                    maintainAspectRatio: false,
                    tooltips: {
                        enabled: true,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function (tooltipItem, data) {
                                return data['labels'][tooltipItem[0]['index']];
                            },
                            label: function (tooltipItem, data) {
                                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + data.datasets[tooltipItem.datasetIndex]['label'];
                            }
                        },
                        backgroundColor: '#eff6ff',
                        titleFontSize: 13,
                        titleFontColor: '#6783b8',
                        titleFontFamily: 'YekanBakhFaNum',
                        titleMarginBottom: 6,
                        bodyFontColor: '#9eaecf',
                        bodyFontFamily: 'YekanBakhFaNum',
                        bodyFontSize: 12,
                        bodySpacing: 4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: false
                    },
                    scales: {
                        yAxes: [{
                            display: true,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            position: NioApp.State.isRTL ? "right" : "left",
                            ticks: {
                                beginAtZero: true,
                                padding: 16,
                                fontColor: "#8094ae"
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 0,
                                zeroLineColor: 'transparent'
                            },

                        }],
                        xAxes: [{
                            display: false,
                            stacked: (_get_data.stacked) ? _get_data.stacked : false,
                            ticks: {
                                fontSize: 9,
                                fontColor: '#9eaecf',
                                fontFamily: 'YekanBakhFaNum',
                                source: 'auto',
                                padding: 0,
                                reverse: NioApp.State.isRTL
                            },
                            gridLines: {
                                color: "transparent",
                                tickMarkLength: 0,
                                zeroLineColor: 'transparent',
                            },
                        }]
                    }
                }
            });
        })
    }
    // init chart
    NioApp.coms.docReady.push(function () { supportStatusChart(); });


})(NioApp, jQuery);