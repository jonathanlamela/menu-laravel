import React from 'react'
import CategoryNavList from '../components/CategoryNavList'
import Layout from '../components/Layout'

export default () => {

    return <>
        <Layout title="Home" globalSearchEnabled={false} nav={<CategoryNavList></CategoryNavList>}>
        </Layout>
    </>

}