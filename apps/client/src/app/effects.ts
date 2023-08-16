import { all, fork } from 'redux-saga/effects'
import newsfeed from '../components/NewsFeed/effects'

const effects = function* (): Generator {
  yield all([
    fork(newsfeed),
  ])
}

export default effects
