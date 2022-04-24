<template>
  <div>
    <div>
      <v-row justify="center">
        <v-dialog v-model="isOpenSaveModal" persistent max-width="600px">
          <v-card>
            <v-card-title>
              <span class="text-h5">貯金記録作成</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                      :value="save.click_date"
                      prepend-icon="mdi-clock-time-eight-outline"
                      readonly
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <TagInput :tag-id.sync="save.tag_id" />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="1">
                    <v-icon>mdi-cat</v-icon>
                  </v-col>
                  <v-col cols="4">
                    <IconModal @set-icon-id="save.icon_id = $event" />
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <MemoInput :memo.sync="save.memo" />
                  </v-col>
                  <v-col cols="12" class="text-right">
                    <span class="text-h2 font-weight-light">{{
                      multipleCoin
                    }}</span>
                    <span class="subheading font-weight-light mr-1">円</span>
                  </v-col>
                  <v-col cols="12">
                    <SaveModalSlider
                      :coin.sync="save.coin"
                      @increment="save.coin++"
                      @decrement="save.coin--"
                    />
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeModal">
                Close
              </v-btn>
              <v-btn
                color="blue darken-1"
                text
                @click="$store.dispatch('save/setOpenSaveModal', false)"
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
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
      <v-sheet height="600">
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
            <div class="event-name text-subtitle-2">{{ event.name }}</div>
          </template>
        </v-calendar>
      </v-sheet>
    </div>
    <SaveList :saves="saves" @save-id-send="setSave" />
  </div>
</template>
<script>
import moment from 'moment'
import MemoInput from '../components/atoms/inputs/MemoInput.vue'
import SaveModalSlider from '../components/molecules/sliders/SaveModalSlider.vue'
import SaveList from '../components/organisms/lists/SaveList.vue'
import IconModal from '../components/organisms/modals/IconModal.vue'
import TagInput from '../components/atoms/inputs/TagInput.vue'
export default {
  name: 'SavePage',
  components: { SaveList, IconModal, MemoInput, SaveModalSlider, TagInput },
  data: () => ({
    save: {
      user_id: '',
      tag_id: 1,
      icon_id: 1,
      coin: 0,
      memo: '',
      click_date: ''
    },
    updateFlag: false,
    saveId: null,
    events: [],
    saves: [
      {
        id: 1,
        user_id: 1,
        tag_id: 2,
        icon_id: 1,
        coin: 3,
        memo: 'aaa',
        click_date: '2022-4-24'
      },
      {
        id: 2,
        user_id: 2,
        tag_id: 1,
        icon_id: 2,
        coin: -2,
        memo: 'sss',
        click_date: '2022-4-25'
      },
      {
        id: 3,
        user_id: 2,
        tag_id: 4,
        icon_id: 4,
        coin: -5,
        memo: 'fffff',
        click_date: '2022-4-26'
      }
    ],
    dayOfWeek: [
      '日曜日',
      '月曜日',
      '火曜日',
      '水曜日',
      '木曜日',
      '金曜日',
      '土曜日'
    ],
    value: moment().format('YYYY-MM-DD')
  }),
  computed: {
    // setSaveId() {
    //   if(this.saveId !== null) {
    //     return true
    //   }
    //   return false
    // },
    calendarTitle() {
      return moment(this.value).format('YYYY年 M月')
    },
    animationDuration() {
      return `${60 / this.coin}s`
    },
    isOpenSaveModal: {
      get() {
        return this.$store.getters['save/openSaveModal']
      },
      set(newVal) {
        this.$store.dispatch('save/setOpenSaveModal', newVal)
      }
    },
    multipleCoin() {
      if (this.save.coin > 0) {
        return `+${this.save.coin * 500}`
      }
      return this.save.coin * 500
    }
  },
  methods: {
    closeModal() {
      this.$store.dispatch('save/setOpenSaveModal', false)
      this.save.user_id = ''
      this.save.tag_id = 1
      this.save.icon_id = 1
      this.save.coin = 0
      this.save.memo = ''
      this.save.click_date = ''
    },
    setSave(saveId) {
      this.saveId = saveId
      for (let i = 0; i < this.saves.length; i++) {
        if (this.saveId === this.saves[i].id) {
          this.save = Object.assign(this.save, this.saves[i])
          this.updateFlag = true
          // routeの出しわけ
          this.$store.dispatch('save/setOpenSaveModal', true)
          return
        }
      }
    },
    getEvents() {
      const events = []
      for (let i = 0; i < this.saves.length; i++) {
        const startDate = this.saves[i].click_date
        events.push({
          name: `${this.saves[i].coin * 500}¥`,
          // momentで時間もつけるかも
          start: startDate
        })
        this.events = events
      }
      // const events = [
      //   {
      //     name: '+500¥',
      //     start: new Date('2022-04-03T01:00:00'), // 開始時刻
      //     end: new Date('2022-04-03T02:00:00'), // 終了時刻
      //     // color: 'blue',
      //     timed: false, // 終日ならfalse
      //     outside: false
      //   }
      // ]
      // this.events = events
    },
    getEventColor(event) {
      return event.color
    },
    showEvent(event) {
      this.$store.dispatch('save/setOpenSaveModal', true)
      this.save.click_date = event.day.date
    },
    dayFormat(date) {
      return new Date(date.date).getDate()
    },
    weekdayFormat(date) {
      return this.dayOfWeek[date.weekday]
    },
    monthFormat(date) {
      return new Date(date.date).getMonth() + 1 + ' /'
    }
  }
}
</script>
<style scoped>
.event-name {
  text-align: center;
  color: black;
}
</style>
