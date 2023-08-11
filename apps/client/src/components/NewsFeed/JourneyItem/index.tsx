import React from 'react'
import { News } from '../../../models/news'
import styled from 'styled-components'

interface Props {
  readonly news: News[]
  readonly date: Date
}

const JourneyItem: React.FC<Props> = ({ news, date }) => {
  const day = date.toLocaleDateString('fr-FR', { weekday: 'long' })

  return <>{ day }</>
}

export default JourneyItem
