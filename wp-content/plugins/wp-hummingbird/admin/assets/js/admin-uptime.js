( function( $ ) {
    WPHB_Admin.uptime = {
        module: 'uptime',
        $dataRangeSelector: null,
        chartData: null,
        timer:null,
        $spinner: null,
        init: function() {
            this.$spinner = $('.spinner');
            this.strings = wphbUptimeStrings;
            this.$dataRangeSelector = $( '#wphb-uptime-data-range' );
            this.chartData = $('#uptime-chart-json').val();
            this.$disableUptime = $('#wphb-disable-uptime');

            this.$dataRangeSelector.change( function() {
                window.location.href = $(this).find( ':selected' ).data( 'url' );
            });

            var self = this;
            this.$disableUptime.change( function() {
                self.$spinner.css( 'visibility', 'visible' );
                var value = $(this).is(':checked');
                if ( value && self.timer ) {
                    clearTimeout( self.timer );
                    self.$spinner.css( 'visibility', 'hidden' );
                }
                else {
                    // you have 3 seconds to change your mind
                    self.timer = setTimeout( function() {
                        location.href = self.strings.disableUptimeURL;
                    }, 3000 );
                }

                return;
            });

            this.drawChart();

            /* Re-check Uptime status */
            $('#uptime-re-check-status').on( 'click', function(e){
                e.preventDefault();
                location.reload();
            });
        },

        drawChart: function() {
            var data = new google.visualization.DataTable();
            data.addColumn('datetime', 'Day');
            data.addColumn('number', 'Response Time (ms)');

            var chart_array = JSON.parse( this.chartData );
            for (var i = 0; i < chart_array.length; i++) {
                chart_array[i][0] = new Date( chart_array[i][0] );
            }

            data.addRows(chart_array);

            var options = {
                legend: { position: 'none' },
                vAxis: { format: 'short' },
                hAxis: { textPosition: 'none' },
                tooltip: { isHtml: true },
                series: {
                    0: {axis: 'Resp'}
                },
                axes: {
                    y: {
                        Resp: {label: 'Response Time (ms)'}
                    }
                }
            };

            var chart = new google.charts.Line(document.getElementById("uptime-chart"));
            chart.draw(data, options);

            $(window).resize(function(){
                chart.draw(data, options);
            });
        }
    };
}(jQuery));