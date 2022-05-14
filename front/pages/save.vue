<template>
  <div>
    <div>
      <v-row justify="center">
        <v-dialog
          v-model="isOpenSaveModal"
          persistent
          max-width="600px"
          :fullscreen="isFullscreen"
        >
          <v-card>
            <v-card-title class="text-center">
              <div class="text-center full-width">
                <h1 class="text-h5 font-weight-medium full-width">
                  貯金記録作成
                </h1>
              </div>
              <div v-if="updateFlag" class="ml-auto">
                <v-icon class="ml-auto" @click="deleteSave">mdi-delete</v-icon>
              </div>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-text-field
                      :value="save.click_date"
                      prepend-icon="mdi-clock-time-eight-outline"
                      color="indigo accent-2"
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
                閉じる
              </v-btn>
              <v-btn color="blue darken-1" text @click="createOrUpdateSave">
                保存
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
      <div class="d-flex justify-space-between pt-8">
        <v-btn icon @click="prevCalender">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
        <div :class="calendarTitleSize">
          {{ calendarTitle }}
        </div>
        <v-btn icon @click="nextCalender">
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn>
      </div>
      <v-card :height="cardHeight" outlined>
        <v-calendar
          ref="calendar"
          v-model="value"
          class="red--text"
          locale="ja-jp"
          event-more-text="その他{0}件"
          :day-format="dayFormat"
          :weekday-format="weekdayFormat"
          :month-format="monthFormat"
          :events="events"
          :event-color="getEventColor"
          @change="getEvents"
          @click:date="showEvent"
          @click:day="showEvent"
        >
          <template #event="{ event }">
            <div class="event-name text-subtitle-2">{{ event.name }}</div>
          </template>
        </v-calendar>
      </v-card>
    </div>
    <v-row>
      <v-col cols="12">
        <sub-title-card class="pb-1 pt-8">
          <template #subTitle>今月の貯金記録</template>
        </sub-title-card>
        <SaveList :saves="savesOneMonth" @save-id-send="setSave" />
      </v-col>
    </v-row>
  </div>
</template>
<script>
import moment from 'moment'
import MemoInput from '../components/atoms/inputs/MemoInput.vue'
import SaveModalSlider from '../components/molecules/sliders/SaveModalSlider.vue'
import SaveList from '../components/organisms/lists/SaveList.vue'
import IconModal from '../components/organisms/modals/IconModal.vue'
import TagInput from '../components/atoms/inputs/TagInput.vue'
import SubTitleCard from '../components/molecules/cards/SubTitleCard.vue'
export default {
  name: 'SavePage',
  components: {
    SaveList,
    IconModal,
    MemoInput,
    SaveModalSlider,
    TagInput,
    SubTitleCard
  },
  data: () => ({
    save: {
      tag_id: 1,
      icon_id: 1,
      coin: 0,
      memo: '',
      click_date: ''
    },
    updateFlag: false,
    saveId: null,
    events: [],
    savesOneMonth: [],
    saves: [],
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
    calendarTitle() {
      return moment(this.value).format('YYYY年 M月')
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
    },
    cardHeight() {
      const brackPointName = this.$vuetify.breakpoint.name
      if (brackPointName === 'xs') {
        return 400
      } else {
        return 600
      }
    },
    calendarTitleSize() {
      const brackPointName = this.$vuetify.breakpoint.name
      if (brackPointName === 'xs') {
        return 'text-h6'
      } else {
        return 'text-h5'
      }
    },
    isFullscreen() {
      const brackPointName = this.$vuetify.breakpoint.name
      if (brackPointName === 'xs') {
        return true
      } else {
        return false
      }
    }
  },
  created() {
    this.saves = JSON.parse(sessionStorage.getItem('saves'))
    this.getSavesOneMonth()
    this.getEvents()
  },
  methods: {
    prevCalender() {
      this.$refs.calendar.prev()
      this.getSavesOneMonth()
    },
    nextCalender() {
      this.$refs.calendar.next()
      this.getSavesOneMonth()
    },
    getSavesAmount() {
      this.$saveApi.getSavesAmount().then((res) => {
        if (res.data !== '') {
          sessionStorage.setItem('saveAmount', JSON.stringify(res.data))
        }
      })
    },
    createOrUpdateSave() {
      if (this.updateFlag === true) {
        this.getSavesAmount()
        this.$saveApi.update(this.saveId, this.save).then((res) => {
          const beforeSave = this.saves.find((save) => save.id === res.data.id)
          Object.assign(beforeSave, res.data)
          sessionStorage.setItem('saves', JSON.stringify(this.saves))

          const beforEvent = this.events.find(
            (event) => event.id === res.data.id
          )
          const saveColor =
            res.data.coin > 0 ? 'indigo accent-2' : 'red lighten-1'
          const event = this.returnEvent(
            res.data.id,
            res.data.coin,
            saveColor,
            res.data.click_date
          )
          Object.assign(beforEvent, event)

          this.getSavesOneMonth()
        })
        this.$store.dispatch('save/setOpenSaveModal', false)
        return
      }
      this.$saveApi.create(this.save).then((res) => {
        console.log(res)
        this.getSavesAmount()
        this.saves.push(res.data)
        sessionStorage.setItem('saves', JSON.stringify(this.saves))
        this.savesOneMonth.push(res.data)
        this.savesOneMonth.sort((a, b) =>
          a.click_date < b.click_date ? -1 : 1
        )

        const saveColor =
          res.data.coin > 0 ? 'indigo accent-2' : 'red lighten-1'
        const event = this.returnEvent(
          res.data.id,
          res.data.coin,
          saveColor,
          res.data.click_date
        )
        this.events.push(event)
      })
      this.$store.dispatch('save/setOpenSaveModal', false)
    },
    deleteSave() {
      this.getSavesAmount()
      this.$saveApi.delete(this.saveId)
      this.saves = this.saves.filter((save) => save.id !== this.saveId)
      sessionStorage.setItem('saves', JSON.stringify(this.saves))

      this.events = this.events.filter((event) => event.id !== this.saveId)

      this.getSavesOneMonth()
      this.$store.dispatch('save/setOpenSaveModal', false)
    },
    getSavesOneMonth() {
      this.savesOneMonth = JSON.parse(sessionStorage.getItem('saves')).filter(
        (save) => {
          const clickDate = moment(save.click_date)
          const startDate = moment(this.value)
            .startOf('month')
            .format('YYYY-MM-DD')
          const endDate = moment(this.value).endOf('month').format('YYYY-MM-DD')
          return clickDate.isBetween(startDate, endDate)
        }
      )
      this.savesOneMonth.sort((a, b) => (a.click_date < b.click_date ? -1 : 1))
    },
    closeModal() {
      this.$store.dispatch('save/setOpenSaveModal', false)
      this.save.tag_id = 1
      this.save.icon_id = 1
      this.save.coin = 0
      this.save.memo = ''
      this.save.click_date = ''
    },
    setSave(saveId) {
      this.saveId = saveId
      this.updateFlag = true
      for (let i = 0; i < this.saves.length; i++) {
        if (this.saveId === this.saves[i].id) {
          this.save = Object.assign(this.save, this.saves[i])

          this.$store.dispatch('save/setOpenSaveModal', true)
          return
        }
      }
    },
    getEvents() {
      const events = []
      for (let i = 0; i < this.saves.length; i++) {
        const save = this.saves[i]
        const saveClickDate = save.click_date
        const saveId = save.id
        const saveColor = save.coin > 0 ? 'indigo accent-2' : 'red lighten-1'
        events.push({
          id: saveId,
          name: `${save.coin * 500}¥`,
          color: saveColor,
          start: saveClickDate
        })
        events.sort((a, b) => (a.click_date < b.click_date ? 1 : -1))
        this.events = events
      }
    },
    returnEvent(saveId, saveCoin, saveColor, saveClickDate) {
      const event = {
        id: saveId,
        name: `${saveCoin * 500}¥`,
        color: saveColor,
        start: saveClickDate
      }
      return event
    },
    getEventColor(event) {
      return event.color
    },
    showEvent(event) {
      this.updateFlag = false
      this.save.click_date = event.date
      this.$store.dispatch('save/setOpenSaveModal', true)
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
}
.full-width {
  width: 100%;
}
</style>
