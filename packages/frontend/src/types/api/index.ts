// TODO: OpenAPIから吐き出したものに置換する
// あるいはここの型定義からOpenAPIのスキーマを吐けるように

export type CreateUserArgs = {
	name: string;
	email: string;
	password: string;
}

export type UpdateUserArgs = {
	name: string;
	email: string;
}

export type UpdateUserPasswordArgs = {
	password: string;
}

export type CreateUserReturnType = {
	userId: string;
	name: string;
	email: string;
	created_at: string;
	updated_at: string;
}

export type UserArgs = {
	id: string;
}

export type MessageArgs = {
	id: string;
}

export type MessagesArgs = {
	lastMessageId?: string;
	perPage?: number;
}
