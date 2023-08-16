import React from 'react'
import { News } from '../../../models/news'
import styled from 'styled-components'
import Item from './Item'

interface Props {
  readonly date: Date
  readonly news: News[]
}

const Daily: React.FC<Props> = ({ news, date }) => {
  const dateFormat = date.toLocaleDateString('fr-FR')
  const day = date.toLocaleDateString('fr-FR', { weekday: 'long' })

  return (
    <Wrapper>
      <Container>
        <Date>{ day } { dateFormat }</Date>
        <DailyWrapper>
          { news.map(
            (dailyNews, i) =>
              <Item
                key={ dailyNews.ID }
                news={ dailyNews }
                latest={ i === 0 }
              />
          ) }
        </DailyWrapper>
      </Container>
    </Wrapper>
  )
}

const Wrapper = styled.div`
`

const Container = styled.div`
`
const Date = styled.div`
  text-align: left;
  font-size: 18px;
  letter-spacing: 2px;
  padding-left: 140px;
`

const DailyWrapper = styled.div`
  display: flex;
  flex-direction: column;
`

export default Daily
