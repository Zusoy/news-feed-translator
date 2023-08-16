import React from 'react'
import styled from 'styled-components'
import { News } from '../../../models/news'

interface Props {
  readonly news: News
  readonly latest: boolean
}

const Item: React.FC<Props> = ({ news, latest }) => {
  const currentDate = new Date(parseInt(news.date_write) * 1000)
  const hoursMinutes = currentDate.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })

  return (
    <Wrapper>
      <Hours latest={ latest }>{ hoursMinutes }</Hours>
      <NewItemLine />
      <Content>
        <Title>{ news.title }</Title>
        { news.subtitle.length > 0
          ? <Subtitle>{ news.subtitle }</Subtitle>
          : null
        }
      </Content>
  </Wrapper>
  )
}

const Wrapper = styled.div`
  display: flex;
  gap: 16px;
  width: 100%;
  margin-bottom: 4px;
`

const Content = styled.div(({ theme }) => `
  display: flex;
  flex-direction: column;
  border: 1px solid transparent;
  flex-grow: 1;
  border-radius: 9px;
`)

const Hours = styled.div<{ latest: boolean }>(( { theme, latest }) => `
  position: relative;
  width: 122px;
  text-align: right;

  ${ latest &&
    `
    font-size: 18px;
    &:before {
      justify-content: center;
      left: 0px;
      top: 0px;
      bottom: 0px;
      padding: 0px 8px;
      content: 'dernier';
      text-transform: uppercase;
      font-size: 18px;
    }
    `
  }
`)

const Title = styled.div(({ theme }) => `
  color: ${ theme.colors.green };
  padding: 2px;
`)

const Subtitle = styled.div(({ theme }) => `
  color: ${ theme.colors.black };
  padding: 2px;
`)

const NewItemLine = styled.div(({ theme }) => `
  position: relative;
  background-color: ${ theme.colors.greenLine };
  width: 8px;
  height: 8px;
  border-radius: 10px;

  &:after {
    content: '';
    position: absolute;
    border-color: ${ theme.colors.greenLine };
    border-style: solid;
    border-width: 0.1em;
    height: 2rem;
    left: 0.15rem;
  }
`)

export default Item
