

 <script>

    @if (is_connected())
        <script>
            var start = moment().subtract(29, "days");
            var end = moment();

            function cb(start, end) {
                $(".date-range-picker").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
            }

            $(".date-range-picker").daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    "Today": [moment(), moment()],
                    "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "Last 30 Days": [moment().subtract(29, "days"), moment()],
                    "This Month": [moment().startOf("month"), moment().endOf("month")],
                    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                        "month")]
                }
            }, cb);

            cb(start, end);
        </script>
            document.getElementById('filter-results').addEventListener('click', function() {

                const user = document.getElementById('user-select').value;
                const tag = document.getElementById('tags-select').value;
                const dateRange = document.getElementById('date-range-picker').value;

                //ajax call to filter contacts
                filterLoader(true);
                $.ajax({
                    url: "{{ route('filter.contacts') }}",
                    type: 'GET',
                    data: {
                        user: user,
                        tag: tag,
                        dateRange: dateRange
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            let tcc = response.top_stats;
                            console.log('Ye wala', tcc);
                            topContactsChart(tcc.contacts);
                            topSalesByMonths(tcc.sales);
                            topAverageYearlySales(tcc.sales.year_wise_sale_count);
                            countryWiseCharts(tcc.countrywise);
                            // top_calls_by_status(tcc.totalcalls, tcc.calls);
                            if (response.html) {
                                document.querySelector('.conversiondiv').innerHTML =
                                    ''; // Clear the existing content
                                document.querySelector('.conversiondiv').innerHTML = response
                                    .html; // Set the new HTML content

                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    },
                    complete: function() {
                        filterLoader(false);
                    }
                });
            });


            //empty the date range picker on load
            $(document).ready(function() {
                $('#date-range-picker').val('');
                //click on filter results button
                $('#filter-results').click();

            });

            //chart assigned by user contacts donut chart
            function assignedByUser(assignedUserData) {
                var seriesData = [];
                var xaxisData = [];
                for (const [key, value] of Object.entries(assignedUserData)) {
                    xaxisData.push(key);
                    seriesData.push(Object.keys(value).length);
                }

                var options = {
                    series: seriesData,
                    chart: {
                        width: 480,
                        type: 'donut',
                    },
                    labels: xaxisData,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#contactsassignedchart"), options);
                chart.render();
            }

            //contact chart on the total contact card
            function allContactsByDate(datewiseContacts) {
                var dates = Object.keys(datewiseContacts);
                var counts = Object.values(datewiseContacts);

                var options = {
                    chart: {
                        type: 'line',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Contacts',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Contacts'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                var chart = new ApexCharts(document.querySelector("#contact_datewise"), options);
                chart.render();
            }


            function contactBasedOnTags(groupedContactsByTags) {
                var seriesData = [];
                Object.keys(groupedContactsByTags).forEach((tag) => {
                    var contactCount = Object.keys(groupedContactsByTags[tag]).length;
                    seriesData.push({
                        x: tag,
                        y: contactCount
                    });
                });

                var options = {
                    chart: {
                        type: 'area',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x', // Enables zooming along the x-axis
                            autoScaleYaxis: true, // Automatically scales the Y-axis
                        },
                        toolbar: {
                            tools: {
                                zoomin: true,
                                zoomout: true,
                                pan: true,
                                reset: true
                            }
                        }
                    },
                    series: [{
                        name: 'Contacts by Tags',
                        data: seriesData
                    }],
                    xaxis: {
                        type: 'category',
                        title: {
                            text: 'Tags'
                        },
                        labels: {
                            rotate: -45 // Rotate labels for better readability
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Contacts'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "Contacts: " + val;
                            }
                        },
                        x: {
                            formatter: function(val) {
                                return "Tag: " + val;
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#grouped_contacts_by_tags"), options);
                chart.render();
            }

            //total contacts count
            // function totalContacts(total_contacts) {
            //     $('.total_contacts').text(total_contacts);
            // }

            // function countryWiseChartsss(countryWiseContacts) {

            //     am5.ready(function() {

            //         console.log(countryWiseContacts);

            //         // Data for leads by country
            //         var leadData = countryWiseContacts;

            //         // Create root and chart
            //         var root = am5.Root.new("group_by_countries");

            //         // Set themes
            //         root.setThemes([am5themes_Animated.new(root)]);

            //         // Create chart
            //         var chart = root.container.children.push(am5map.MapChart.new(root, {
            //             homeZoomLevel: 0.5,
            //             homeGeoPoint: {
            //                 longitude: 10,
            //                 latitude: 52
            //             }
            //         }));

            //         // Create world polygon series
            //         var worldSeries = chart.series.push(am5map.MapPolygonSeries.new(root, {
            //             geoJSON: am5geodata_worldLow,
            //             exclude: ["AQ"]
            //         }));

            //         // Set up map polygons template
            //         worldSeries.mapPolygons.template.setAll({
            //             tooltipText: "{name}: {leads} leads",
            //             fill: am5.color(0xCCCCCC),
            //             nonScalingStroke: true,
            //             strokeOpacity: 0.5,
            //             strokeWidth: 0.5,
            //             label: 50
            //         });

            //         // Define color based on leads
            //         worldSeries.mapPolygons.template.adapters.add("fill", function(fill, target) {
            //             var dataItem = target.dataItem.dataContext;
            //             if (dataItem.leads > 0) {
            //                 return am5.color(0x00CC00); // Green color for countries with leads
            //             } else {
            //                 return am5.color(0xCCCCCC); // Grey color for countries with 0 or no leads
            //             }
            //         });

            //         // Add data to map
            //         worldSeries.data.setAll(leadData);

            //         worldSeries.events.on("datavalidated", () => {
            //             chart.goHome();
            //         });

            //     }); // end am5.ready()

            // }

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
                            return am5.color(0x00CC00); // Green color for countries with leads
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




            function allChartsRender(response) {
                console.log(response.contact_stats, response.opportunities_stats, response.oppointment_stats, response
                    .call_stats);
                let assignedUserData = response.contact_stats['grouped_contacts'];
                let datewiseContacts = response.contact_stats['datewise_contacts'];
                let total_contacts = response.contact_stats['total_contacts'];
                let groupedContactsByTags = response.contact_stats['grouped_contacts_by_tags'];
                let conuntrywise = response.contact_stats['group_by_countries'];
                totalContacts(total_contacts);
                assignedByUser(assignedUserData);
                allContactsByDate(datewiseContacts);
                contactBasedOnTags(groupedContactsByTags);
                countryWiseCharts(conuntrywise);
                daywise_count(response.opportunities_stats['daywise_count']);
                opportunities_assigned_per_user(response.opportunities_stats['opportunities_assigned_per_user']);
                //opportunities_by_source(response.opportunities_stats['opportunities_by_source']);
                opportunities_by_status(response.opportunities_stats['opportunities_by_status']);
                monetary_value_distribution(response.opportunities_stats['monetary_value_distribution']);
                pipelinewiseopportunities(response.opportunities_stats['pipelineswise']);
                showTotalOpportunities(response.opportunities_stats['total_opportunities']);
                leadToSaleConversionChart(response.opportunities_stats['lead_to_sale']);
                appointments_by_status(response.oppointment_stats['appointments_by_status']);
                appointments_assigned_per_user(response.oppointment_stats['appointments_assigned_per_user']);
                appointments_by_source(response.oppointment_stats['appointments_by_source']);
                appointments_by_daywise(response.oppointment_stats['daywise_count']);
                showTotalAppointments(response.oppointment_stats['total_appointments']);
                appointments_by_calendars(response.oppointment_stats['appointments_by_calendars']);
                calls_by_daywise(response.call_stats['daywise_count']);
                showTotalCalls(response.call_stats['total_calls']);
            }

            //call all the charts
        </script>


        {{-- Opportunities Stats Charts --}}
        <script>
            function daywise_count(daywise_count) {
                var dates = Object.keys(daywise_count);
                var counts = Object.values(daywise_count);

                var options = {
                    chart: {
                        type: 'line',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Opportunities',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Opportunities'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                var chart = new ApexCharts(document.querySelector("#daywise_count_chart"), options);
                chart.render();
            }

            function opportunities_assigned_per_user(opportunities_assigned_per_user) {
                var seriesData = [];
                var xaxisData = [];
                for (const [key, value] of Object.entries(opportunities_assigned_per_user)) {
                    xaxisData.push(key);
                    seriesData.push(Object.keys(value).length);
                }

                var options = {
                    series: seriesData,
                    chart: {
                        width: 480,
                        type: 'donut',
                    },
                    labels: xaxisData,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#opportunities_assigned_per_user_chart"), options);
                chart.render();
            }


            function opportunities_by_status(opportunities_by_status) {

                var labels = Object.keys(opportunities_by_status);
                var values = Object.values(opportunities_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: labels,
                    colors: ['#FF4560', '#00E396'], // Adjust colors if necessary
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#opportunities_by_status_chart"), options);
                chart.render();
            }

            function monetary_value_distribution(data) {

                var dates = data.dates;
                var revenue_values = data.revenue;
                var lost_values = data.lost;
                var expected_values = data.expected;

                var options = {
                    series: [{
                            name: 'Revenue',
                            data: revenue_values
                        },
                        {
                            name: 'Lost',
                            data: lost_values
                        },
                        {
                            name: 'Expected',
                            data: expected_values
                        }
                    ],
                    chart: {
                        type: 'line',
                        height: 350
                    },
                    xaxis: {
                        categories: dates,
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Amount'
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#monetary_value_distribution_chart"), options);
                chart.render();
            }

            //pipelines wise opportunities
            function pipelinewiseopportunities(pipelinesWise) {
                const pipelines = Object.keys(pipelinesWise);
                const stages = new Set();
                const seriesData = [];

                pipelines.forEach(pipeline => {
                    const stagesData = pipelinesWise[pipeline];
                    Object.keys(stagesData).forEach(stage => stages.add(stage));
                });

                const stageArray = Array.from(stages);

                stageArray.forEach(stage => {
                    seriesData.push({
                        name: stage,
                        data: pipelines.map(pipeline => {
                            return pipelinesWise[pipeline][stage] || 0;
                        })
                    });
                });

                const options = {
                    chart: {
                        type: 'bar',
                        height: 400,
                        stacked: true,
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '60%',
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    series: seriesData,
                    xaxis: {
                        categories: pipelines,
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Opportunities'
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left',
                    }
                };

                const chart = new ApexCharts(document.querySelector("#pipelines_wise_chart"), options);
                chart.render();

            }

            function showTotalOpportunities(total_opportunities) {
                $('#total_opportunities').text(total_opportunities);
            }


            function leadToSaleConversionChart(leadToSale) {
                $('#total_opportunities_conversion').text(leadToSale.conversion_rate + '%');
                const chartOptions = {
                    chart: {
                        type: 'donut',
                        height: 300
                    },
                    series: [
                        leadToSale.won,
                        leadToSale.contacts - leadToSale.won
                    ],
                    labels: ['Won Leads', 'Not Converted'],
                    colors: ['#1cc88a', '#e74a3b']
                };

                var chart = new ApexCharts(document.querySelector("#lead_to_sale_count_chart"), chartOptions);
                chart.render();
            }

            //call the charts
            // let opportunitiesStats = {!! json_encode($opportunities_stats) !!};
            // daywise_count(opportunitiesStats['daywise_count']);
            // opportunities_assigned_per_user(opportunitiesStats['opportunities_assigned_per_user']);
            // // opportunities_by_source(opportunitiesStats['opportunities_by_source']);
            // opportunities_by_status(opportunitiesStats['opportunities_by_status']);
            // monetary_value_distribution(opportunitiesStats['monetary_value_distribution']);
            // pipelinewiseopportunities(opportunitiesStats['pipelineswise']);
            // showTotalOpportunities(opportunitiesStats['total_opportunities']);
            // leadToSaleConversionChart(opportunitiesStats['lead_to_sale']);
        </script>


        {{-- Appointments Stats Charts --}}
        <script>
            /*
                                                                                                                                                                                                                                                                                                                                                      {"total_appointments":2,"appointments_by_status":{"confirmed":2},"appointments_by_source":{"booking_widget":1,"calendar_page":1},"appointments_assigned_per_user":{"Zulkifal Hassan":[],"Pervaiz Malik":[],"Usman Zaheer ":[],"Awais Saleem":[],"Muhammad Orhan":[],"Shoaib Sultan":[],"Abraham Peter":[],"Sabir Shah":[],"M Safian ":[],"Ali Hassan":[],"Ayaz Khan":[],"Awais Qarni":[],"Saqib Ali":[],"M Waseem":[],"Faiza Bibi":[],"Anwar Hussain":{"1":{"id":2,"ghl_appointment_id":"4ngL3x1hQ6HCmZ2P7c6T","location_id":"vcLxBfw01Nmv2VnlhtND","address":"https:\/\/us05web.zoom.us\/j\/85875585824?pwd=aJwbFon5VxBME9Za9NNox0xa0qpGyC.1","title":"Test Oppointment","calendar_id":"wmquOnn9rm2Su0KI16IO","contact_id":"btDRSwAYUrxjTwHx6hul","group_id":null,"appointment_status":"confirmed","assigned_user_id":"tAeeuUTKOCuOwo4jjzlo","users":null,"notes":null,"source":"calendar_page","start_time":"2024-08-20 10:00:00","end_time":"2024-08-20 10:30:00","date_added":"2024-08-19 18:40:30","date_updated":null,"deleted_at":null,"created_at":"2024-08-19T18:40:33.000000Z","updated_at":"2024-08-19T18:40:33.000000Z"}},"M Usman Ali":[],"Rehmat Faizan":[]},"daywise_count":{"2023-09-25":1,"2024-08-19":1},"appointments_by_calendars":{"faiza test neww":[],"appointment book 1":[],"robin calendar":[],"Robin calendar Safian":[],"haider":[],"Waseem training Pract-1":[],"Beard":[],"safian test":[],"faiza-new":[],"Practice-2":[],"faiza":[],"High Medium Low":[],"test anwar":[],"appointment book":[],"Book An Appointment":[],"book appointment":[],"Select Date And Time":[],"Sabir Roof Replacement Booking Calendar":[],"Simple calender":[],"SAA Delivery":[],"calander":[],"Sabir Free Roof Inspection Calendar":[],"simple calendar":[],"anwar multi members":[],"Faiza-simple calendar":[],"Cutting":[],"Collective":[],"Anwar calendar Test":[],"Neat Feat Podiatry Calender ":[],"Free Roof Inspection Calendar":[],"Bingo":[],"Unlock Your Business Potential with Expert Consultation!":[],"ali calander":[],"collective calendar":[],"test Anwar":[],"Appointment With Saqib":[],"Team Calendar":[],"class calendar":[],"faiza- practice":[],"appointment booking":[],"Cutting and Beard":[],"Anwaar 1st calender":[],"haider calander":[],"Bingo 2":[],"Faiza- round robin":[],"roof maintenance":[],"faiza-practice":[],"Round Robin":[],"Testing calendar":[],"anwar work":[{"id":1,"ghl_appointment_id":"0007BWpSzSwfiuSl0tR2","location_id":"vcLxBfw01Nmv2VnlhtND","address":"https:\/\/example.com\/meeting","title":"Appointment with GHL Dev team","calendar_id":"wmquOnn9rm2Su0KI16IO","contact_id":"vcLxBfw01Nmv2VnlhtND","group_id":"9NkT25Vor1v4aQatFsv2","appointment_status":"confirmed","assigned_user_id":"YlWd2wuCAZQzh2cH1fVZ","users":"[\"YlWd2wuCAZQzh2cH1fVZ\",\"9NkT25Vor1v4aQatFsv2\"]","notes":"Some dummy note","source":"booking_widget","start_time":"2023-09-25 16:00:00","end_time":"2023-09-25 16:00:00","date_added":"2023-09-25 16:00:00","date_updated":null,"deleted_at":null,"created_at":"2024-08-19T18:36:30.000000Z","updated_at":"2024-08-19T18:36:30.000000Z"},{"id":2,"ghl_appointment_id":"4ngL3x1hQ6HCmZ2P7c6T","location_id":"vcLxBfw01Nmv2VnlhtND","address":"https:\/\/us05web.zoom.us\/j\/85875585824?pwd=aJwbFon5VxBME9Za9NNox0xa0qpGyC.1","title":"Test Oppointment","calendar_id":"wmquOnn9rm2Su0KI16IO","contact_id":"btDRSwAYUrxjTwHx6hul","group_id":null,"appointment_status":"confirmed","assigned_user_id":"tAeeuUTKOCuOwo4jjzlo","users":null,"notes":null,"source":"calendar_page","start_time":"2024-08-20 10:00:00","end_time":"2024-08-20 10:30:00","date_added":"2024-08-19 18:40:30","date_updated":null,"deleted_at":null,"created_at":"2024-08-19T18:40:33.000000Z","updated_at":"2024-08-19T18:40:33.000000Z"}],"OutBound Calender":[]}}
                                                                                                                                                                                                                                                                                                                                                    */

            function appointments_by_status(appointments_by_status) {
                var labels = Object.keys(appointments_by_status);
                var values = Object.values(appointments_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: labels,
                    colors: ['#FF4560', '#00E396'], // Adjust colors if necessary
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#appointments_by_status_chart"), options);
                chart.render();
            }

            function appointments_assigned_per_user(appointments_assigned_per_user) {
                var seriesData = [];
                var xaxisData = [];
                for (const [key, value] of Object.entries(appointments_assigned_per_user)) {
                    xaxisData.push(key);
                    seriesData.push(Object.keys(value).length);
                }

                var options = {
                    series: seriesData,
                    chart: {
                        width: 480,
                        type: 'donut',
                    },
                    labels: xaxisData,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#appointments_assigned_per_user_chart"), options);
                chart.render();
            }

            function appointments_by_source(appointments_by_source) {
                var seriesData = [];
                var labels = [];

                Object.keys(appointments_by_source).forEach((source) => {
                    console.log(source);
                    console.log(appointments_by_source[source]);
                    var appointmentCount = appointments_by_source[source];
                    seriesData.push(appointmentCount);
                    labels.push(source);
                });


                var options = {
                    chart: {
                        type: 'pie',
                        height: 280
                    },
                    series: seriesData,
                    labels: labels,
                    colors: ['#f3a4b5', '#ffbb33', '#34bfa3'],
                    dataLabels: {
                        enabled: true
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "Appointments: " + val;
                            }
                        },
                        x: {
                            formatter: function(val) {
                                return "Source: " + val;
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#appointments_by_source_chart"), options);
                chart.render();
            }

            function appointments_by_daywise(appointments_by_daywise) {
                var dates = Object.keys(appointments_by_daywise);
                var counts = Object.values(appointments_by_daywise);

                var options = {
                    chart: {
                        type: 'line',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Appointments',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Appointments'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                var chart = new ApexCharts(document.querySelector("#appointment_by_daywise"), options);
                chart.render();
            }


            //appointment calendars
            function appointments_by_calendars(appointments_by_calendars) {
                var labels = [];
                var data = [];

                // Transform data for the polar area chart
                Object.keys(appointments_by_calendars).forEach((calendar) => {
                    var appointmentCount = Object.keys(appointments_by_calendars[calendar]).length;
                    labels.push(calendar);
                    data.push(appointmentCount);
                });

                var options = {
                    chart: {
                        type: 'polarArea',
                        height: 500
                    },
                    series: data,
                    labels: labels,
                    colors: ['#f3a4b5', '#ffbb33', '#34bfa3', '#ff4560', '#00e396', '#775dd0', '#546e7a', '#d4526e',
                        '#308a6d', '#a5b1c2'
                    ],
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ['#000'] // Adjust color for better contrast
                        }
                    },
                    plotOptions: {
                        polarArea: {
                            rings: {
                                strokeWidth: 0 // Optional: Hide the rings
                            }
                        }
                    },
                    legend: {
                        position: 'bottom' // Place legend at the bottom
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "Appointments: " + val;
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 400 // Adjust height on smaller screens
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#appointments_calendar_wise_chart"), options);
                chart.render();
            }


            function showTotalAppointments(total_appointments) {
                $('#appointments_by_source').text(total_appointments);
            }

            //call the charts
            // let appointmentsStats = {!! json_encode($oppointment_stats) !!};
            // console.log(appointmentsStats);
            // appointments_by_status(appointmentsStats['appointments_by_status']);
            // appointments_assigned_per_user(appointmentsStats['appointments_assigned_per_user']);
            // appointments_by_source(appointmentsStats['appointments_by_source']);
            // appointments_by_daywise(appointmentsStats['daywise_count']);
            // showTotalAppointments(appointmentsStats['total_appointments']);
            // appointments_by_calendars(appointmentsStats['appointments_by_calendars']);
        </script>


        {{-- Calls Stats Charts --}}
        <script>
            function calls_by_daywise(calls_by_daywise) {
                var dates = Object.keys(calls_by_daywise);
                var counts = Object.values(calls_by_daywise);

                var options = {
                    chart: {
                        type: 'line',
                        height: 280,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Calls',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Calls'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                var chart = new ApexCharts(document.querySelector("#calls_by_daywise"), options);
                chart.render();
            }

            function showTotalCalls(total_calls) {
                $('#total_calls').text(total_calls);
            }

            //call the charts
            // let callsStats = {!! json_encode($call_stats) !!};
            // calls_by_daywise(callsStats['daywise_count']);
            // showTotalCalls(callsStats['total_calls']);
        </script>

        {{-- top stats charts --}}

        <script>
            function topContactsChart(topStats) {
                // Update the total contacts display
                document.querySelector('.top_total_contact').innerHTML = topStats.total_contacts;



                // Define the options for the new chart
                var options = {
                    chart: {
                        type: 'donut',
                        height: 200, // Keep the height as is to fit within the card
                        width: '100%', // Ensure the chart fits within the card's width
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
                    legend: {
                        position: 'right', // Position the legend to the right of the chart
                        fontSize: '10px', // Adjust the font size to fit the legend within the small card
                        offsetY: 0, // Ensure the legend is vertically centered
                        itemMargin: {
                            horizontal: 5,
                            vertical: 5
                        },
                        formatter: function(seriesName, opts) {
                            return seriesName + ": " + opts.w.globals.series[opts.seriesIndex];
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






            function top_opportunities_by_status(total = 0, opportunities_by_status) {
                document.querySelector('.top_total_opportunity').innerHTML = total;
                var labels = Object.keys(opportunities_by_status);
                var values = Object.values(opportunities_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 180
                    },
                    labels: labels,
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 180,
                        options: {
                            chart: {
                                height: 180
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#top_opportunities_chart"), options);
                chart.render();
            }

            function top_appointments_by_status(total = 0, appointments_by_status) {
                document.querySelector('.top_total_oppointments').innerHTML = total;
                var labels = Object.keys(appointments_by_status);
                var values = Object.values(appointments_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: labels,
                    colors: ['#FF4560', '#00E396'], // Adjust colors if necessary
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#top_total_appointments"), options);
                chart.render();
            }

            function topSalesByMonths(saleByMonth) {
                // Update the total sales display
                document.querySelector('.top_total_sales').innerText = saleByMonth.total;

                // Extract dates and counts from the saleByMonth object
                var dates = Object.keys(saleByMonth.won_opportunities);
                var counts = Object.values(saleByMonth.won_opportunities);

                // Destroy the existing chart if it exists
                if (window.topSalesChart) {
                    window.topSalesChart.destroy();
                }

                // Define the options for the new chart
                var options = {
                    chart: {
                        type: 'line',
                        height: 350,
                        zoom: {
                            enabled: true,
                            type: 'x',
                            autoScaleYaxis: true
                        },
                        toolbar: {
                            autoSelected: 'zoom',
                            show: false
                        }
                    },
                    series: [{
                        name: 'Total Sales',
                        data: counts
                    }],
                    xaxis: {
                        categories: dates,
                        tickAmount: 5,
                        labels: {
                            formatter: function(value, timestamp) {
                                return value;
                            }
                        },
                        title: {
                            text: 'Date'
                        }
                    },
                    yaxis: {
                        title: {
                            text: 'Number of Sales'
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    markers: {
                        size: 5
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // Alternate row color
                            opacity: 0.5
                        }
                    },
                    tooltip: {
                        x: {
                            format: 'yyyy-MM-dd'
                        }
                    },
                    fill: {
                        opacity: 0.8
                    }
                };

                // Create and render the new chart, storing the instance globally
                window.topSalesChart = new ApexCharts(document.querySelector("#top_sales_chart"), options);
                window.topSalesChart.render();
            }


            function top_calls_by_status(total = 0, calls_by_status) {
                document.querySelector('.top_total_calls').innerHTML = total;
                var labels = Object.keys(calls_by_status);
                var values = Object.values(calls_by_status);

                var options = {
                    series: values,
                    chart: {
                        type: 'donut',
                        height: 350
                    },
                    labels: labels,
                    colors: ['#FF4560', '#00E396'], // Adjust colors if necessary
                    dataLabels: {
                        enabled: true
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '70%'
                            }
                        }
                    },
                    responsive: [{
                        breakpoint: 600,
                        options: {
                            chart: {
                                height: 300
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };

                var chart = new ApexCharts(document.querySelector("#top_total_calls"), options);
                chart.render();
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
                            distributed: true // Colors for each bar
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


            // top_opps_by_assign_user_chart




            let tcc = @json($top_stats);
            console.log("top start");
            console.log(tcc);
            console.log("top end");

            topContactsChart(tcc.contacts);
            topSalesByMonths(tcc.sales);
            topAverageYearlySales(tcc.sales.year_wise_sale_count);
            countryWiseCharts(tcc.countrywise);
            // top_opportunities_by_status(tcc.totaloppor, tcc.opportunities);
            // top_appointments_by_status(tcc.totaloppo, tcc.appointments);
            top_calls_by_status(tcc.totalcalls, tcc.calls);
        </script>
    @endif

