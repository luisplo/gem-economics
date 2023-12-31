import React, { useEffect, useState } from 'react';
import axios from 'axios';
import Loader from './Loader'

export default function Dashboard() {
    const [data, setData] = useState({
        activities: {
            used_values: 0,
            values: 0,
            complete: 0,
            incomplete: 0,
        },
        rewards: {
            complete: 0,
            incomplete: 0,
        }
    })

    const [loading, setLoading] = useState(false);

    const getData = () => {
        setLoading(true)
        axios.get('/api/dashboard')
            .then(res => {
                setData(res.data);
            }).finally(() => {
                setLoading(false)
            })
    }

    useEffect(() => {
        getData()
    }, [])

    return (
        <div className="w-full text-center">
            <h1 className="text-4xl font-semibold pb-8 capitalize">statistics</h1>

            {
                !loading ? (
                    <>
                        <div className="stats shadow ">
                            <div className="stat place-items-center">
                                <div className="stat-title ">Total used gems</div>
                                <div className="stat-value">{data.activities.used_values}</div>
                            </div>
                            <div className="stat place-items-center">
                                <div className="stat-title">Total available gems</div>
                                <div className="stat-value text-success">{data.activities.values}</div>
                            </div>
                        </div>
                        <br />
                        <div className="stats shadow mt-5">
                            <div className="stat place-items-center">
                                <div className="stat-title">Completed activities</div>
                                <div className="stat-value text-success">{data.activities.complete}</div>
                            </div>
                            <div className="stat place-items-center">
                                <div className="stat-title">Activities to complete</div>
                                <div className="stat-value text-warning">{data.activities.incomplete}</div>
                            </div>
                        </div>
                        <br />
                        <div className="stats shadow mt-5">
                            <div className="stat place-items-center">
                                <div className="stat-title">Completed rewards</div>
                                <div className="stat-value ">{data.rewards.complete}</div>
                            </div>
                            <div className="stat place-items-center">
                                <div className="stat-title">Rewards to complete</div>
                                <div className="stat-value text-success">{data.rewards.incomplete}</div>
                            </div>
                        </div>
                        <br />
                    </>
                ) : (
                    <Loader loading={loading} />
                )
            }

        </div>
    );
}
