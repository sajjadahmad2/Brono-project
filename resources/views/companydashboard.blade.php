@extends('layouts.app')
@section('title', 'Companies Dashboard')
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.52.0/apexcharts.min.css"
        integrity="sha512-w3pXofOHrtYzBYpJwC6TzPH6SxD6HLAbT/rffdkA759nCQvYi5AHy5trNWFboZnj4xtdyK0AFMBtck9eTmwybg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .contacts_charts_container .card-toolbar {
            display: none !important;
        }

        .flex-column-fluid {
            flex: 0.1 auto !important;
        }

        .total_opportunities {
            display: none !important;
        }

        .apexcharts-legend-text {
            display: flex;
            gap: 10px;
        }

        .apexcharts-legend-marker {
            height: 8px !important;
            width: 13px !important;
            left: -3px !important;
            top: 0px !important;
        }

        .main-div {
            margin-top: -5%;
        }


        .daterangepicker .drp-calendar td.active:not(.inactive) {
            background-color: #1b84ff !important;
            color: white !important;
            border-radius: .475rem;
        }

        .daterangepicker .drp-calendar td.active.start-date {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .daterangepicker .drp-calendar td.in-range.available:not(.active):not(.off):not(.today) {
            background-color: #f9f9f9 !important;
            color: #1b84ff !important
        }

        .daterangepicker .drp-calendar td.available:hover,
        .daterangepicker .drp-calendar th.available:hover {
            border-radius: .475rem;
            background-color: #f9f9f9 !important;
            color: #1b84ff !important
        }
    </style>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
@endsection
@section('content')
    <div class="contacts_charts_container">
        <div class="row gx-5 gx-xl-10">
            <!-- Location Filter on the Left Side -->
            <div class="col-md-3 mb-3 d-none">
                <select id="location-select" class="form-select">
                    <option value="">Select Location</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location['id'] }}">{{ $location['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Other filters or content can be placed here -->
        </div>
        <div class="col-md-12  mb-3 d-flex justify-content-end align-items-center" style="gap: 20px;">
            <!-- User Dropdown -->
            <div class="col-md-3" style="
            width: 15%;
        ">
                <select id="user-select" class="form-select">
                    <option value="">Select User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tags Dropdown (Hidden Initially) -->
            <div class="col-md-3" style="
            width: 20%;
        "id="tags-filter" hidden>
                <select id="tags-select" class="form-select">
                    <option value="">Select Tag</option>
                </select>
            </div>

            <!-- Date Range Picker -->
            <div class="mb-3">
                <input type="text" class=" btn btn-secondary w-80" placeholder="Pick date rage"
                    id="kt_daterangepicker_4s" />

            </div>
        </div>
        <!-- Main stats and other content goes here -->
        <div class="row gx-5 gx-xl-10 mb-xl-10">
            <!-- Your other content -->
        </div>

        <div class='content-section'>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.52.0/apexcharts.min.js"
        integrity="sha512-piY4QAXPoG2xLdUZZbcc5klXzMxckrQKY9A2o6nKDRt9inolvvLbvGPC+z9IZ29b28UJlD05B7CjxxPaxh4bjQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script>
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#kt_daterangepicker_4s").val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#kt_daterangepicker_4s").daterangepicker({
            startDate: start,
            endDate: end,
            showDropdowns: true, // Enable month and year dropdowns
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                    "month")]
            },
            locale: {
                format: "MMMM D, YYYY"
            }
        }, cb);

        cb(start, end);
    </script>


    <script>
        $(document).ready(function() {
            // Empty the date range picker fields on page load
            $('#kt_daterangepicker_4s').val('');
        });
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#kt_daterangepicker_4s").val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $("#kt_daterangepicker_4s").daterangepicker({
            startDate: start,
            endDate: end,
            showDropdowns: true, // Enable month and year dropdowns
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                    "month")]
            },
            locale: {
                format: "MMMM D, YYYY"
            }
        }, cb);

        cb(start, end);



        // Event listener for when a date range is applied
        $("#kt_daterangepicker_4s").on('apply.daterangepicker', function(ev, picker) {
            var appliedDateRange = picker.startDate.format('MMMM D, YYYY') + " - " + picker.endDate.format(
                'MMMM D, YYYY');
            console.log("data applied " + appliedDateRange);
            filterContacts();
        });

        function getElementValueById(id) {
            const element = document.getElementById(id);
            return element ? element.value : null;
        }
        document.addEventListener('DOMContentLoaded', function() {


            function loadContent(locid = null) {
                //var defaultLocationId = locid;
                var defaultLocationId = '0fu8c2Te17KqLDYyr8RE'; // Default location ID
                console.log('sajjad');
                const user = getElementValueById('user-select');
                const tag = getElementValueById('tags-select');
                //const dateRange = $('#kt_daterangepicker_4s').val();

                // Combine the start and end dates into a single dateRange string if both are selected
                //const dateRange = startDate && endDate ? `${startDate} - ${endDate}` : '';
                if (defaultLocationId) {
                    // Perform the AJAX request
                    filterLoader(true);
                    $.ajax({
                        url: "{{ route('filter.by.location') }}", // Replace with your route
                        type: 'GET',
                        data: {
                            location_id: defaultLocationId,
                            user: user,
                            tag: tag,
                            //dateRange: dateRange
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                // Update the page content based on the response
                                document.querySelector('.content-section').innerHTML = ' ';
                                document.querySelector('.content-section').innerHTML = response.html;
                                let tcc = response.top_stats;
                                console.log(tcc);
                                topContactsChart(tcc.contacts);
                                topSalesByMonths(tcc.sales);
                                topAverageYearlySales(tcc.sales.year_wise_sale_count);
                                countryWiseCharts(tcc.countrywise);

                                // document.getElementById('datepicker-range-start').addEventListener('changeDate', filterContacts);
                            }
                        },
                        error: function(error) {
                            document.querySelector('.content-section').innerHTML = ' ';
                            console.error('Error:', error);
                        },
                        complete: function() {
                            filterLoader(false);
                        }
                    });
                }
            }
            loadContent();

            // Also attach the function to the location select change event
            document.getElementById('location-select').addEventListener('change', function() {
                const locationId = this.value;
                loadContent(locationId);
            });
            document.getElementById('user-select').addEventListener('change', function() {

                loadContent();
            });
            document.getElementById('kt_daterangepicker_4s').addEventListener('change', loadContent);

        });



        function filterLoader(showLoader = false) {
            let contactDiv = document.querySelector('.contacts_charts_container');
            let existingLoader = document.querySelector('.custom-loader');

            if (showLoader) {
                // If no loader exists, create and append it
                if (!existingLoader) {
                    let loader = document.createElement('div');
                    loader.className = 'custom-loader d-flex justify-content-center align-items-center';
                    loader.style.position = 'absolute';
                    loader.style.top = '0';
                    loader.style.left = '0';
                    loader.style.width = '100%';
                    loader.style.height = '100%';
                    loader.style.background = 'rgba(255, 255, 255, 0.8)';
                    loader.innerHTML = `
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>`;
                    contactDiv.style.position = 'relative';
                    contactDiv.appendChild(loader);
                }
            } else {
                // Remove the loader if it exists
                if (existingLoader) {
                    contactDiv.removeChild(existingLoader);
                }
            }
        }

        // Initialize and render charts (examples provided)
        function topContactsChart(topStats) {
            // Update the total contacts display
            document.querySelector('.top_total_contact').innerHTML = topStats.total_contacts;



            // Define the options for the new chart
            var options = {
                dataLabels: {
                    enabled: false,
                    formatter: function(val) {
                        return val + "%"
                    },

                },
                chart: {
                    type: 'donut',
                    height: 120, // Keep the height as is to fit within the card
                    width: '100%',
                    events: {
                        mounted: function(chartContext, config) {
                            // After the chart is rendered, replace the class
                            var legendTexts = document.querySelectorAll('.apexcharts-legend-text');
                            legendTexts.forEach(function(legendText) {
                                legendText.classList.remove('apexcharts-legend-text');
                                legendText.classList.add('text-gray-500', 'flex-grow-1', 'me-4', "fs-6",
                                    "gap-4", "d-flex", "align-item-center", "justify-between");
                            });

                        }
                    } // Ensure the chart fits within the card's width
                },
                series: [
                    topStats.total_contacts,
                    topStats.agencies,
                    topStats.leads,
                    topStats.recruitment,
                    topStats.no_tags,
                    topStats.sollicitants
                ],
                labels: [
                    'Total Contacts',
                    'Agencies',
                    'Leads',
                    'Recruitment',
                    'No Tags',
                    'Sollicitants'
                ],
                colors: ["#f8285a", "#1b84ff", "#e4e6ef"],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '60%'
                        }
                    }
                },
                legend: {
                    position: 'right', // Position the legend to the right of the chart
                    fontSize: '10px', // Adjust the font size to fit the legend within the small card
                    offsetY: 0, // Ensure the legend is vertically centered
                    itemMargin: {
                        horizontal: 0,
                        vertical: 10
                    },
                    formatter: function(seriesName, opts) {
                        return `
                                 <div style="font-weight:600">${seriesName}</div>
                                 <div class="fw-bolder text-gray-700 text-xxl-end fs-6">${opts.w.globals.series[opts.seriesIndex]}</div>
                                `;
                    }
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 150 // Reduce the height on smaller screens
                        },
                        legend: {
                            position: 'bottom', // Move legend below on smaller screens
                            offsetY: 0,
                            itemMargin: {
                                horizontal: 5,
                                vertical: 5
                            }
                        }
                    }
                }]
            };
            if (window.topContactsChartInstance) {
                window.topContactsChartInstance.destroy();
            }
            // Create and render the new chart, storing the instance globally
            window.topContactsChartInstance = new ApexCharts(document.querySelector("#top_contacts_chart"), options);
            window.topContactsChartInstance.render();
        }

        function topSalesByMonths(saleByMonth) {
            // Update the total sales display
            document.querySelector('.top_total_sales').innerText = saleByMonth.total;

            // Extract dates and counts from the saleByMonth object
            var dates = Object.keys(saleByMonth.won_opportunities).map(dateString => {
                var date = new Date(dateString);
                return date.toLocaleDateString('en-US', {
                    month: 'short',
                    day: '2-digit'
                });
            });
            var counts = Object.values(saleByMonth.won_opportunities);

            // Destroy the existing chart if it exists
            if (window.topSalesChart) {
                window.topSalesChart.destroy();
            }

            // Define the options for the new chart
            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    zoom: {
                        enabled: true,
                        type: 'x',
                        autoScaleYaxis: false
                    },
                    toolbar: {
                        autoSelected: 'zoom',
                        show: false
                    },
                },
                series: [{
                    name: 'Total Sales',
                    data: counts
                }],
                colors: ['#17c653'],
                xaxis: {
                    categories: dates,
                    tickAmount: 5,
                    labels: {
                        formatter: function(value, timestamp) {
                            return value;
                        }
                    },

                },
                yaxis: {

                    labels: {
                        formatter: function(value) {
                            return `$${value} K`; // Format y-axis labels as $count K
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 0
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 5,
                    row: {
                        colors: ['transparent', 'transparent'],
                        opacity: 0.5
                    }
                },
                tooltip: {
                    x: {
                        format: 'yyyy-MM-dd'
                    }
                },
                plotOptions: {
                    line: {
                        dropShadow: {
                            enabled: true,
                            top: 3,
                            left: 3,
                            blur: 4,
                            opacity: 0.2
                        }
                    }
                }
            };

            // Create and render the new chart, storing the instance globally
            window.topSalesChart = new ApexCharts(document.querySelector("#top_sales_chart"), options);
            window.topSalesChart.render();
        }

        function countryWiseCharts(countryWiseContacts) {
            console.log("initialized map");
            console.log(countryWiseContacts);

            // Check if the root instance exists and dispose of it
            if (window.countryMapRoot) {
                window.countryMapRoot.dispose();
            }

            am5.ready(function() {
                // Create root and chart
                var root = am5.Root.new("group_by_countries");

                // Store the root instance in a global variable
                window.countryMapRoot = root;

                // Increase the size of the root container
                root.container.setAll({
                    width: am5.percent(100),
                    height: am5.percent(100)
                });

                // Set themes
                root.setThemes([am5themes_Animated.new(root)]);

                // Create chart
                var chart = root.container.children.push(am5map.MapChart.new(root, {
                    homeZoomLevel: 1.3, // Increase zoom level for a closer view
                    homeGeoPoint: {
                        longitude: 10, // Adjust longitude to center the map as desired
                        latitude: 52 // Adjust latitude to center the map as desired
                    }
                }));

                // Create world polygon series
                var worldSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_worldLow,
                    exclude: ["AQ"]
                }));

                // Set up map polygons template
                worldSeries.mapPolygons.template.setAll({
                    tooltipText: "{name}: {leads} leads",
                    fill: am5.color(0xCCCCCC),
                    nonScalingStroke: true,
                    strokeOpacity: 0.5,
                    strokeWidth: 0.5
                });

                // Define color based on leads
                worldSeries.mapPolygons.template.adapters.add("fill", function(fill, target) {
                    var dataItem = target.dataItem.dataContext;
                    if (dataItem.leads > 0) {
                        return am5.color("#1b84ff"); // Green color for countries with leads
                    } else {
                        return am5.color(0xCCCCCC); // Grey color for countries with 0 or no leads
                    }
                });

                // Add data to map
                worldSeries.data.setAll(countryWiseContacts);

                worldSeries.events.on("datavalidated", () => {
                    chart.goHome();
                });
            }); // end am5.ready()
        }

        function topAverageYearlySales(dailySalesPercentages) {
            // Calculate the total sum of the percentages
            const total = Object.values(dailySalesPercentages).reduce((sum, value) => sum + value, 0);
            document.querySelector('.AverageYearlySales').innerText = '$ ' + total;

            // Extract labels and data from the dailySalesPercentages object
            const labels = Object.keys(dailySalesPercentages);
            const data = Object.values(dailySalesPercentages);

            // Destroy the existing chart if it exists
            if (window.topAvgDailySalesChart) {
                window.topAvgDailySalesChart.destroy();
            }

            // Define the options for the new chart
            const options = {
                chart: {
                    type: 'bar',
                    height: 220,
                },
                series: [{
                    name: 'Yearly Sales Percentages',
                    data: data
                }],
                plotOptions: {
                    bar: {
                        borderRadius: 10, // Rounded bars for a "bullet" look
                        columnWidth: '10%', // Thin bars
                        distributed: false // Colors for each bar
                    }
                },
                xaxis: {
                    categories: labels,
                    labels: {
                        rotate: -45, // Rotate labels for readability
                        style: {
                            colors: '#333' // Label color
                        }
                    },
                    axisBorder: {
                        show: false // Hide x-axis border
                    },
                    axisTicks: {
                        show: false // Hide x-axis ticks
                    },
                },
                yaxis: {
                    labels: {
                        show: false, // Hide y-axis labels
                        style: {
                            colors: '#333' // Label color
                        }
                    }
                },
                grid: {
                    show: false // Hide grid lines
                },
                dataLabels: {
                    enabled: false // Hide data labels
                },
                legend: {
                    show: false // Hide legend
                }
            };

            // Create and render the new chart, storing the instance globally
            window.topAvgDailySalesChart = new ApexCharts(document.querySelector("#top_avg_daily_sales_chart"), options);
            window.topAvgDailySalesChart.render();
        }

        // Example function for initializing the map
        function initMap() {
            am5.ready(function() {
                var root = am5.Root.new("map_chart");

                root.setThemes([
                    am5themes_Animated.new(root)
                ]);

                var chart = root.container.children.push(am5map.MapChart.new(root, {
                    projection: am5map.geoMercator()
                }));

                var polygonSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
                    geoJSON: am5geodata_worldLow
                }));

                polygonSeries.mapPolygons.template.setAll({
                    tooltipText: "{name}",
                    toggleKey: "active",
                    interactive: true
                });

                polygonSeries.mapPolygons.template.states.create("hover", {
                    fill: am5.color(0x677935)
                });

                chart.set("zoomControl", am5map.ZoomControl.new(root, {}));
                chart.chartContainer.get("background").events.on("click", function() {
                    chart.goHome();
                });
            });
        }
    </script>
@endsection
