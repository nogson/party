<script>
  import {Radar} from 'vue-chartjs'

  export default {
    name: "RadarChart",
    extends: Radar,
    props: {
      data: {
        type: Object,
        default: () => {
        }
      }
    },
    data() {
      return {
        options: {
          animation: true,
          legend: {display: false},
          scale: {
            display: true,
            pointLabels: {
              fontSize: 12,
              fontColor: '#CCC'
            },
            ticks: {
              display: false,
              fontSize: 12,
              fontColor: '#000',
              min: 0,
              max: 5,
              beginAtZero: true,
              stepSize:1
            },
            gridLines: {
              display: true,
              color: '#F3F3F3'
            },
          }
        }
      }
    },
    mounted() {
      this.renderChart(this.data, this.options)
    }
  }
</script>

<style scoped>

</style>