export class ApiErrorResponse {
  constructor(
    public readonly status: number,
    public readonly url: string
  ) {}
}

const handleResponseErrors = async (response: Response) => {
  if (!response.ok) {
    throw new ApiErrorResponse(
      response.status,
      response.url
    )
  }
}

async function http(path: string, config: RequestInit) {
  const request = new Request(`http://127.0.0.1:8081${path}`, config)
  const response = await fetch(request)

  await handleResponseErrors(response)

  return response.json().catch(() => {})
}

export type ApiGet = <T>(path: string, config?: RequestInit) => Promise<T>
export const get: ApiGet = (path, config) => {
  const init: RequestInit = { ...config, method: 'get' }

  return http(path, init)
}
