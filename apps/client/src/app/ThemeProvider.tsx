import React, { PropsWithChildren } from 'react'
import { ThemeProvider as StyledProvider } from 'styled-components'
import { theme } from './theme'

const ThemeProvider: React.FC<PropsWithChildren> = ({ children }) =>
  <StyledProvider theme={ theme }>
    { children }
  </StyledProvider>

export default ThemeProvider
