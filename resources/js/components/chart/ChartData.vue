<script>
  import {Line} from 'vue-chartjs';

  export default {
    extends: Line,
    mounted() {
      let cropName = ''
      let location = ''
      this.$store.subscribe((mutation, state) => {
        if (mutation.type === 'chart_data/mutateChartData') {

          //console.log(mutation.payload)
          let chartItems = state.chart_data['chartData']
          let years = new Array()
          let labels = new Array()
          let values = new Array()

          let i
          for (i = 0; i < chartItems.length; i++) {
            cropName = chartItems[i].crop;
            location = chartItems[i].location;
            let chartDataItems = chartItems[i].chartDataItems
            chartDataItems.forEach(dataItem => {
              years.push(dataItem.year)
              labels.push(dataItem.year)
              values.push(dataItem.harvest)
            })
          }

          //render chart
          this.renderChart({
            labels: years,
            datasets: [{
              label: location + " - " + cropName,
              backgroundColor: '#ADD8E6',
              data: values
            }]
          }, {responsive: true, maintainAspectRatio: false})
        }
      })
    }
  }
</script>

