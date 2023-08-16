import { createSlice, PayloadAction } from '@reduxjs/toolkit'
import { News } from '../../models/news'
import { Selector } from '../../app/store'

export enum FeedStatus {
  Fetching = 'Fetching',
  Received = 'Received',
  Error = 'Error'
}

export interface State {
  items: News[],
  status: FeedStatus
}

export const initialState: State = {
  items: [],
  status: FeedStatus.Fetching
}

const slice = createSlice({
  name: 'newsfeed',
  initialState,
  reducers: {
    fetchAll: state => ({
      ...state,
      status: FeedStatus.Fetching,
    }),
    received: (state, action: PayloadAction<News[]>) => ({
      ...state,
      items: action.payload,
      status: FeedStatus.Received
    }),
    error: state => ({
      ...state,
      status: FeedStatus.Error
    })
  }
})

export const {
  fetchAll,
  received,
  error,
} = slice.actions

export interface DailyNews {
  [key: string]: News[]
}

export const selectNews: Selector<News[]> = state => state.newsfeed.items
export const selectDailyNews: Selector<DailyNews> = state => {
  let daily: DailyNews = {}

  state.newsfeed.items.forEach(news => {
    const date = new Date(parseInt(news.date_write) * 1000)
    const dateFormat = date.toLocaleDateString('en-US')

    daily[dateFormat] = daily[dateFormat] !== undefined
      ? [...daily[dateFormat], news]
      : [ news ]
  })

  return daily
}

export default slice
