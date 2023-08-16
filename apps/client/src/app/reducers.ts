import { combineReducers } from 'redux'
import newsfeed from '../components/NewsFeed/slice'

export default combineReducers({
  newsfeed: newsfeed.reducer,
})
