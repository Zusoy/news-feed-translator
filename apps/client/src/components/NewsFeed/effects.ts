import { call, put, takeLatest } from 'redux-saga/effects'
import { fetchAll, received, error } from './slice'
import { get } from '../../services/api'
import { News } from '../../models/news'

export function* fetchAllEffect(): Generator {
  try {
    const items = (yield call(get, '/api/newsfeeds')) as News[]
    yield put(received(items))
  } catch (e) {
    yield put(error())
  }
}

export default function* rootSaga(): Generator {
  yield takeLatest(fetchAll, fetchAllEffect)
}
