<template>
   <div>
    <v-sheet height="64">
      <v-toolbar flat>
        <v-btn icon @click="$refs.calendar.prev()">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
        <v-btn icon @click="$refs.calendar.next()">
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn>
        <v-toolbar-title>
          {{ calendarTitle }}
        </v-toolbar-title>
      </v-toolbar>
    </v-sheet>
    <v-sheet height="600" >
      <v-calendar
        ref="calendar"
        v-model="value"
        class="red--text"
        color="primary"
        locale="ja-jp"
        :day-format="dayFormat"
        :weekday-format="weekdayFormat"
        :month-format="monthFormat"
        :events="events"
        :event-color="getEventColor"
        @change="getEvents"
        @click:event="showEvent"
      >
        <template #event="{ event }">
          <div class="event-name text-subtitle-2">{{event.name}}</div>
        </template>
      </v-calendar>
    </v-sheet>
  </div>
</template>
<script>
import moment from 'moment'
export default {
  data: () => ({
    events: [],
    dayOfWeek: ['日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日'],
    value: moment().format('YYYY-MM-DD')
  }),
  computed: {
    calendarTitle() {
      return moment(this.value).format('YYYY年 M月')
    }
  },
  methods: {
    getEvents() {
      const events = [
        {
          name: '+500¥',
          start: new Date('2022-04-03T01:00:00'), // 開始時刻
          end: new Date('2022-04-03T02:00:00'), // 終了時刻
          // color: 'blue',
          timed: false, // 終日ならfalse
          outside: false,
        },
      ];
      this.events = events;
    },
    getEventColor(event) {
      return event.color;
    },
    showEvent(event) {
      this.$store.dispatch('save/setOpenSaveModal', true)
      this.$store.dispatch('save/setClickDate', event.day.date)
    },
    dayFormat(date){
        return new Date(date.date).getDate()
    },
    weekdayFormat(date){
        return this.dayOfWeek[date.weekday]
    },
    monthFormat(date){
        return new Date(date.date).getMonth()+1+' /'
    }
  },
};
</script>
<style scoped>
 .event-name {
   text-align: center;
   color: black;
 }
</style>
