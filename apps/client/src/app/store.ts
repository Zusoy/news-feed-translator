import { configureStore } from '@reduxjs/toolkit'
import createSagaMiddleware from '@redux-saga/core'
import reducers from './reducers'
import effects from './effects'

const sagaMiddleware = createSagaMiddleware()

export const store = configureStore({
  reducer: reducers,
  middleware: (getDefaultMiddleware) => getDefaultMiddleware().concat(sagaMiddleware)
})

sagaMiddleware.run(effects)

export type RootState = ReturnType<typeof store.getState>
export type Selector<S> = (state: RootState) => S
export type Dispatch = typeof store.dispatch
