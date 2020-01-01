<script>
    import { Line } from 'vue-chartjs'


    export default {
        extends: Line,
        props: ['labels', 'datasets'],
        computed: {
            'chartdata': function () {
                return {
                    labels: this.labels,
                    datasets: this.datasets
                }
            }
        },
        mounted () {
            this.renderChart(this.chartdata, {responsive: true, maintainAspectRatio: true})
        }
    }
</script>