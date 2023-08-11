import React from 'react'
import Theme from './app/ThemeProvider'
import NewsFeed from './components/NewsFeed'
import { newsMocks } from './test-utils'

const App: React.FC = () =>
  <Theme>
    <NewsFeed news={ newsMocks }/>
  </Theme>

export default App
