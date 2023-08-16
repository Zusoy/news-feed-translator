import React, { PropsWithChildren } from 'react'
import { Provider } from 'react-redux'
import { store } from './store'

const StoreProvider: React.FC<PropsWithChildren> = ({ children }) =>
  <Provider store={ store }>
    { children }
  </Provider>

export default StoreProvider
