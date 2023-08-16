import React from 'react'
import Theme from './app/ThemeProvider'
import NewsFeed from './components/NewsFeed'

const App: React.FC = () =>
  <Theme>
    <NewsFeed />
  </Theme>

export default App
