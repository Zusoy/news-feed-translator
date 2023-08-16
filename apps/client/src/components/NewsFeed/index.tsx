import React, { useEffect } from 'react'
import { fetchAll, selectDailyNews } from './slice'
import { useDispatch, useSelector } from 'react-redux'
import styled from 'styled-components'
import Daily from './Daily'

const NewsFeed: React.FC = () => {
  const dispatch = useDispatch()
  const news = useSelector(selectDailyNews)

  useEffect(() => {
    dispatch(fetchAll())
  }, [ dispatch ])

  return (
    <Wrapper>
      <Container>
        <Header></Header>
        <Content>
          <ContentWrapper>
            { Object.keys(news).map(
              (timeday, i) =>
                <Daily
                  key={ i }
                  news={ news[timeday] }
                  date={ new Date(Date.parse(timeday)) }
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
  align-items: center;
  justify-content: center;
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
  display: flex;
  flex-direction: column;
  gap: 15px;
`

export default NewsFeed
