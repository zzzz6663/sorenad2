!(function (NioApp, $) {
    "use strict";

    var refBarChart = {
        labels: ["01 شهریور", "02 شهریور", "03 شهریور", "04 شهریور", "05 شهریور", "06 شهریور", "07 شهریور", "08 شهریور", "09 شهریور", "10 شهریور", "11 شهریور", "12 شهریور", "13 شهریور", "14 شهریور", "15 شهریور", "16 شهریور", "17 شهریور", "18 شهریور", "19 شهریور", "20 شهریور", "21 شهریور", "22 شهریور", "23 شهریور", "24 شهریور", "25 شهریور", "26 شهریور", "27 شهریور", "28 شهریور", "29 شهریور", "30 شهریور"],
        dataUnit: 'نفر',
        datasets: [{
            label: "عضو",
            color: "#6baafe",
            data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 90]
        }]
    };

    var profitCM = {
        labels: ["01 شهریور", "02 شهریور", "03 شهریور", "04 شهریور", "05 شهریور", "06 شهریور", "07 شهریور", "08 شهریور", "09 شهریور", "10 شهریور", "11 شهریور", "12 شهریور", "13 شهریور", "14 شهریور", "15 شهریور", "16 شهریور", "17 شهریور", "18 شهریور", "19 شهریور", "20 شهریور", "21 شهریور", "22 شهریور", "23 شهریور", "24 شهریور", "25 شهریور", "26 شهریور", "27 شهریور", "28 شهریور", "29 شهریور", "30 شهریور"],
        dataUnit: 'تومان',
        datasets: [{
            label: "ارسال",
            color: "#5d7ce0",
            data: [0, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 0]
        }]
    };

    function referStats(elem, set_data) {
        var $elem = (elem) ? $(elem) : $('.chart-refer-stats');
        $elem.each(function () {
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;

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
                    barPercentage: .5,
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
                        backgroundColor: '#fff',
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
                            ticks: {
                                beginAtZero: true
                            },
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
    NioApp.coms.docReady.push(function () { referStats(); });


    function investProfit(elem, set_data) {
        var $elem = (elem) ? $(elem) : $('.chart-profit');
        $elem.each(function () {
            var $self = $(this), _self_id = $self.attr('id'), _get_data = (typeof set_data === 'undefined') ? eval(_self_id) : set_data;
            var selectCanvas = document.getElementById(_self_id).getContext("2d");

            var chart_data = [];
            for (var i = 0; i < _get_data.datasets.length; i++) {
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension: .4,
                    backgroundColor: NioApp.hexRGB(_get_data.datasets[i].color, .3),
                    borderWidth: 2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: 'transparent',
                    pointBackgroundColor: 'transparent',
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 4,
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
                        backgroundColor: '#fff',
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
                            ticks: {
                                beginAtZero: true
                            }
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
    NioApp.coms.docReady.push(function () { investProfit(); });

    //////////////// ADMIN PANEL /////////////
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


    var totalDeposit = {
        labels: ["01 فروردین", "02 فروردین", "03 فروردین", "04 فروردین", "05 فروردین", "06 فروردین", "07 فروردین"],
        dataUnit: 'تومان',
        stacked: true,
        datasets: [{
            label: "کاربر فعال",
            color: [NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), NioApp.hexRGB("#733AEA", .2), "#733AEA"],
            data: [7200, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };

    var totalWithdraw = {
        labels: ["01 فروردین", "02 فروردین", "03 فروردین", "04 فروردین", "05 فروردین", "06 فروردین", "07 فروردین"],
        dataUnit: 'تومان',
        stacked: true,
        datasets: [{
            label: "کاربر فعال",
            color: [NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), "#816bff"],
            data: [7200, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };

    var totalBalance = {
        labels: ["01 فروردین", "02 فروردین", "03 فروردین", "04 فروردین", "05 فروردین", "06 فروردین", "07 فروردین"],
        dataUnit: 'تومان',
        stacked: true,
        datasets: [{
            label: "کاربر فعال",
            color: [NioApp.hexRGB("#AB89F2", .2), NioApp.hexRGB("#AB89F2", .2), NioApp.hexRGB("#AB89F2", .2), NioApp.hexRGB("#AB89F2", .2), NioApp.hexRGB("#AB89F2", .2), NioApp.hexRGB("#AB89F2", .2), "#AB89F2"],
            data: [6000, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };

    function ivDataChart(selector, set_data) {
        var $selector = (selector) ? $(selector) : $('.iv-data-chart');
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
    NioApp.coms.docReady.push(function () { ivDataChart(); });

    var planPurchase = {
        labels: ["01 فروردین", "02 فروردین", "03 فروردین", "04 فروردین", "05 فروردین", "06 فروردین", "07 فروردین", "01 فروردین", "02 فروردین", "03 فروردین", "04 فروردین", "05 فروردین", "06 فروردین", "07 فروردین", "01 فروردین", "02 فروردین", "03 فروردین", "04 فروردین", "05 فروردین", "06 فروردین", "07 فروردین"],
        dataUnit: 'تومان',
        stacked: true,
        datasets: [{
            label: "کاربر فعال",
            color: NioApp.hexRGB("#733AEA", .3),
            colorHover: "#733AEA",
            data: [6000, 8200, 7800, 9500, 5500, 9200, 9690, 6000, 8200, 7800, 9500, 5500, 9200, 9690, 6000, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };

    function ivPlanPurchase(selector, set_data) {
        var $selector = (selector) ? $(selector) : $('.iv-plan-purchase');
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
                    hoverBackgroundColor: _get_data.datasets[i].colorHover,
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
    NioApp.coms.docReady.push(function () { ivPlanPurchase(); });


    var userActivity = {
        labels: ["01 بهمن", "02 بهمن", "03 بهمن", "04 بهمن", "05 بهمن", "06 بهمن", "07 بهمن", "08 بهمن", "09 بهمن", "10 بهمن", "11 بهمن", "12 بهمن", "13 بهمن", "14 بهمن", "15 بهمن", "16 بهمن", "17 بهمن", "18 بهمن", "19 بهمن", "20 بهمن", "21 بهمن"],
        dataUnit: 'نفر',
        stacked: true,
        datasets: [{
            label: "عضویت مستقیم",
            color: "#6baafe",
            data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90]
        }, {
            label: "عضویت ارجاعی",
            color: "#ccd4ff",
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



})(NioApp, jQuery);