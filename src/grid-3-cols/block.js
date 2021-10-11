/**
 * BLOCK: Cards 2 columns without images
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import "./editor.scss";
import "./style.scss";

const { __ } = wp.i18n; // Import __() from wp.i18n
const { registerBlockType } = wp.blocks; // Import registerBlockType() from wp.blocks
import {
	Flex,
	Card,
	FlexBlock,
	CardBody,
	TextareaControl,
	TextControl,
} from "@wordpress/components";

registerBlockType("cgb/block-3-cols", {
	// Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
	title: __("Cards 3 columns with images"), // Block title.
	icon: "text-page", // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
	category: "common", // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
	keywords: [
		__("my-blocks — CGB Block"),
		__("CGB Example"),
		__("create-guten-block"),
	],

	attributes: {
		posts: {
			type: "array",
			default: [
				{
					title: "",
					link: "",
					description: "",
					picture: "",
				},
				{
					title: "",
					link: "",
					description: "",
					picture: "",
				},
				{
					title: "",
					link: "",
					description: "",
					picture: "",
				},
			],
		},
	},
	edit: ({ attributes, setAttributes }) => {
		async function getPostPic(link) {
			const slug = link.match(/(?<=(http:\/\/|https:\/\/).*?\/).*?(?=\/)/g)[0];
			console.log("Slug", slug);
			try {
				const postData = await wp.apiFetch({
					url: `../wp-json/wp/v2/posts?slug=${slug}`,
				});
				console.log("Post Data", postData);
				const imgData = await wp.apiFetch({
					url: `../wp-json/wp/v2/media/${postData[0].featured_media}`,
				});
				console.log("IMG Data - ", imgData);
				console.log("Ссылка на картинку - ", imgData.source_url);
				return imgData.source_url;
			} catch (e) {
				console.log("Во время получения картинки возникла ошибка - ", e);
			}
		}

		async function setPostData(value, n, field) {
			let posts = [...attributes.posts];
			posts[n][field] = value;
			setAttributes({
				posts,
			});
			if (field === "link") {
				const imgLink = await getPostPic(value);
				let posts = [...attributes.posts];
				posts[n]["picture"] = imgLink;
				setAttributes({
					posts,
				});
			}
		}
		return (
			<Flex>
				<FlexBlock>
					<Card>
						<CardBody>
							<TextControl
								label="Заголовок"
								value={attributes.posts[0].title}
								onChange={(value) => setPostData(value, 0, "title")}
							/>
							<TextareaControl
								label="Описание"
								value={attributes.posts[0].description}
								onChange={(value) => setPostData(value, 0, "description")}
							/>
							<TextControl
								label="Ссылка"
								value={attributes.posts[0].link}
								onChange={(value) => setPostData(value, 0, "link")}
							/>
						</CardBody>
					</Card>
				</FlexBlock>
				<FlexBlock>
					<Card>
						<CardBody>
							<TextControl
								label="Заголовок"
								value={attributes.posts[1].title}
								onChange={(value) => setPostData(value, 1, "title")}
							/>
							<TextareaControl
								label="Описание"
								value={attributes.posts[1].description}
								onChange={(value) => setPostData(value, 1, "description")}
							/>
							<TextControl
								label="Ссылка"
								value={attributes.posts[1].link}
								onChange={(value) => setPostData(value, 1, "link")}
							/>
						</CardBody>
					</Card>
				</FlexBlock>
				<FlexBlock>
					<Card>
						<CardBody>
							<TextControl
								label="Заголовок"
								value={attributes.posts[2].title}
								onChange={(value) => setPostData(value, 2, "title")}
							/>
							<TextareaControl
								label="Описание"
								value={attributes.posts[2].description}
								onChange={(value) => setPostData(value, 2, "description")}
							/>
							<TextControl
								label="Ссылка"
								value={attributes.posts[2].link}
								onChange={(value) => setPostData(value, 2, "link")}
							/>
						</CardBody>
					</Card>
				</FlexBlock>
			</Flex>
		);
	},

	save: (props) => {
		return null;
	},
});
