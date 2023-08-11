import React from 'react'
import { News } from '../../models/news'
import JourneyItem from './JourneyItem'
import styled from 'styled-components'

interface Props {
  readonly news: News[]
}

interface NewsByTime {
  [key: string]: News[]
}

const sortByTimeday = (news: News[]): NewsByTime => {
  let newsByTime: {[key: string]: News[]} = {}

  news.forEach(news => {
    newsByTime[news.dateWrite] = newsByTime[news.dateWrite] !== undefined
      ? [ ...newsByTime[news.dateWrite], news ]
      : [ news ]
  })

  return newsByTime
}

const NewsFeed: React.FC<Props> = ({ news }) => {
  const newsByDay = sortByTimeday(news)

  return (
    <Wrapper>
      <Container>
        <Header></Header>
        <Content>
          <ContentWrapper>
            { Object.keys(newsByDay).map(
              timeday =>
                <JourneyItem
                  key={ timeday }
                  news={ newsByDay[timeday] }
                  date={ new Date(parseInt(timeday)) }
                />
            ) }
          </ContentWrapper>
        </Content>
      </Container>
    </Wrapper>
  )
}

const Wrapper = styled.div`
  position: relative;
  width: 100%;
  height: 100%;
`

const Container = styled.div`
  display: flex;
  flex-direction: column;
  height: 100%;
`

const Header = styled.div`
  width: 100%;
  display: flex;
  flex-direction: row;
  align-items: center;
`

const Content = styled.div`
  position: relative;
  width: 100%;
  height: 100%;
`

const ContentWrapper = styled.div`
  position: absolute;
`

export default NewsFeed
